function inserirDados($nome, $email, $telefone) {
    // Obter a conexão com o banco de dados
    $pdo = conectarBancoDeDados();

    // Se a conexão for bem-sucedida, realizar a inserção
    if ($pdo) {
        try {
            // Nome da tabela
            $table = 'sua_tabela';

            // Preparar a instrução SQL usando prepared statement
            $stmt = $pdo->prepare("INSERT INTO $table (nome, email, telefone) VALUES (:nome, :email, :telefone)");

            // Vincular os parâmetros
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);

            // Executar a instrução SQL
            $stmt->execute();

            echo 'Inserção bem-sucedida!';
        } catch (PDOException $e) {
            // Capturar a exceção em caso de erro na inserção
            echo 'Erro na inserção: ' . $e->getMessage();
        }
    }
}

// Exemplo de uso da função de inserção
inserirDados('Nome do Usuário', 'usuario@example.com', '123-456-7890');