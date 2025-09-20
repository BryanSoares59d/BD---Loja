<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>QualiPet - Casa de rações</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none">Clarence Taylor</span>
                <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="assets/img/logo.png" alt="..." /></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#sobre">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#planilha">Planilha</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#cadastro">Cadastrar</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#atualizar">Atualizar</a></li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid p-0">
            <section class="resume-section" id="sobre">
                <div class="resume-section-content">
                    <h1>QUALI PET</h1>
                    <h2>Qualidade que seu pet sente, carinho que você vê!</h2>
                    <p class="container">A QualiPet nasceu com o propósito de oferecer mais saúde, sabor e felicidade para os melhores amigos do ser humano. Trabalhamos com rações e petiscos cuidadosamente selecionados, feitos com ingredientes de qualidade, que garantem nutrição balanceada e momentos de prazer para o seu cão. Porque sabemos que ele não é só um pet, é parte da família.</p>
                </div>
            </section>
            <hr class="m-0" />


            <section class="resume-section" id="planilha">
                <div class="resume-section-content">
                    <div class="container">
                        <h1 class="tit">TABELA DE PRODUTOS QUALIPET</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">NOME</th>
                                <th scope="col">PREÇO</th>
                                <th scope="col">QUANTIDADE</th>
                                <th scope="col">OPÇÕES</th>
                                </tr>
                            </thead>

                            <tbody>
                                
                                <?php
                                    require 'conexao.php';
                                    $sql = "SELECT * FROM produtos";
                                    $stmt = $pdo->query($sql);
                                    while ($produto = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                        echo"<tr>";
                                        
                                        echo"<td>".  $produto['id']."</td>";
                                        echo"<td>" . $produto['nome'] . "</td>";
                                        echo"<td>" . $produto['preco'] . "</td>";
                                        echo"<td>" . $produto['quantidade'] . "</td>";
                                        echo "<td>
                                        <div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                                            <a href='?id=".$produto['id']."#atualizar' type='button' class='btn btn-danger'>Atualizar</a>
                                            <a href='apagar.php?id=".$produto['id']."' type='button' class='btn btn-warning'>Apagar</a>
                                        </div>
                                    </td>";
                                        echo"</tr>";
                                    }
                                ?>
                            
                            </tbody>
                        </table>
                    </div>
                </div>  
            </section>
            <hr class="m-0" />
            <section class="resume-section" id="cadastro">
                <div class="resume-section-content">
                    <?php
                        include 'cabecalho.php';
                    ?>
                        <div class="container">
                            <h2>CADASTRO DE PRODUTO</h2>
                            <form action="inserir.php" method="POST">
                                <div class="mb-3">                
                                    <input type="text" name="nome" class="form-control" placeholder="Digite o nome do Produto">                
                                </div>
                                <div class="mb-3">                
                                    <input type="text"name="preco" class="form-control" placeholder="Digite o preço do Produto">                
                                </div>
                                <div class="mb-3">                
                                    <input type="text"name="quantidade" class="form-control" placeholder="Digite a quantidade">                
                                </div>
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </form>
                        </div>
                </div>
            </section>
            <hr class="m-0" />
            <section class="resume-section" id="atualizar">
                <div class="resume-section-content">
                    <?php
                        include 'cabecalho.php';
                        require 'conexao.php';

                        if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
                            $id = (int) $_GET["id"];
                            $sql = "SELECT * FROM produtos WHERE id = :id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute(["id" => $id]);

                            $produto = $stmt->fetch(PDO::FETCH_ASSOC);

                            if (!$produto) {
                                echo "<p>Produto não encontrado!</p>";
                                exit;
                            }
                        } else {
                            echo "<p>ID inválido ou não informado!</p>";
                            exit;
                        }
                    ?>
                    <div class="container">
                        <h2>Atualização DE PRODUTO</h2>
                        <form action="#" method="POST">
                            <div class="mb-3">                
                                Nome:
                                <input value="<?php echo htmlspecialchars($produto["nome"]); ?>" type="text" name="nome" class="form-control">              
                            </div>

                            <div class="mb-3">     
                                Preço:           
                                <input value="<?php echo htmlspecialchars($produto["preco"]); ?>" type="text" name="preco" class="form-control">             
                            </div>

                            <div class="mb-3">                
                                Quantidade:
                                <input value="<?php echo htmlspecialchars($produto["quantidade"]); ?>" type="text" name="quantidade" class="form-control">              
                            </div>

                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>
                    </div>
            </section>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
