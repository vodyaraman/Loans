<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Database\Database;

class LoansController
{
    public function create(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        // Валидация входных данных
        if (
            !isset($data['amount']) || !is_numeric($data['amount']) ||
            !isset($data['term']) || !is_numeric($data['term']) ||
            !isset($data['interest_rate']) || !is_numeric($data['interest_rate']) ||
            !isset($data['start_date']) || !isset($data['end_date'])
        ) {
            $response->getBody()->write(json_encode([
                'error' => 'Invalid input: Check all required fields.',
                'received' => $data
            ]));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        // Получение подключения к базе данных
        $db = Database::getConnection();

        // SQL запрос для вставки нового займа
        $sql = "INSERT INTO loans (amount, term, interest_rate, start_date, end_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            $data['amount'], $data['term'], $data['interest_rate'], $data['start_date'], $data['end_date']
        ]);
        $loanId = $db->lastInsertId();

        // Отправка ответа о создании займа
        $response->getBody()->write(json_encode(['message' => 'Loan created', 'loan_id' => $loanId]));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getLoan(Request $request, Response $response, array $args): Response
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM loans WHERE id = :id");
        $stmt->execute(['id' => $args['id']]);
        $data = $stmt->fetch();
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function update(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE loans SET amount = :amount WHERE id = :id");
        $stmt->execute(['id' => $args['id'], 'amount' => $data['amount']]);
        $response->getBody()->write(json_encode(['message' => 'Loan updated']));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM loans WHERE id = :id");
        $stmt->execute(['id' => $args['id']]);
        return $response->withStatus(204);
    }

    public function getLoans(Request $request, Response $response): Response
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM loans");
        $data = $stmt->fetchAll();
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
