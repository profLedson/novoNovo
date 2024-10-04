<?php
$conn = new PDO("mysql:host=localhost;dbname=usuario", "root", "0386");
function conectaDB($conn)
{
    try {

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("ConnErr: " . $e->getMessage());
    }
}

//VALIDAÇÃO DO POST
if (isset($_POST["login"], $_POST["senha"])) {
    $sql = $conn->prepare("INSERT INTO dados VALUES(NULL, ?, ?)");
    $sql->execute(array($_POST["login"], $_POST["senha"]));
    echo "Usuário inserido com sucesso!";
}
// LENDO VALORES

$stmt = $conn->prepare("SELECT * FROM dados");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['usuario'] . " " . $row['senha'] . "<br/>";
}
// ATUALIZANDO VALORES
$stmt = $conn->prepare("UPDATE dados SET usuario = :usuario, senha = :senha WHERE id = :id");
$stmt->bindParam(':usuario', $novoValor1);
$stmt->bindParam(':senha', $novoValor2);
$stmt->bindParam(':id', $id);
$stmt->execute();

// DELETANDO VALORES
$stmt = $conn->prepare("DELETE FROM dados WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();



//https://www.youtube.com/watch?v=uG64BgrlX7o