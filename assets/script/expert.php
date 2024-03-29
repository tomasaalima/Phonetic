<?php
    include_once('db_connection.php');
    include_once('dataManager.php');

    searchWords("EXPERT");
    searchPronunces("EXPERT");
    rankRegister($name, $punctuation, "EXPERT");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/background.css">
    <link rel="stylesheet" href="../css/gameElements.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <title>Game</title>

</head>
<body class="container d-flex flex-column justify-content-center">
    <audio src="#" id="somPalavra"></audio>

        <!--Barra de progresso-->
        <div class="progress my-3">
            <div class="progress-bar"></div>
        </div>   

        <!--Game-->
        <div class="container bg-dark rounded text-center rounded">
            <div class="container my-3">
                <strong class="display-4 text-capitalize text-white">
                <?php
                    reload($actual, $usados);
                    echo $palavras[$actual];
                ?>
                    <button id="sound-player" class="icon-container" onclick="playMusic()">
                    
                    <?php
                        $var_sound = "../sounds/expert/" . $sons[$actual]; 
                    ?>
                    <script>
                        <?php
                            echo "var jsvar = '$var_sound';";
                        ?>
                        function playMusic(){
                            var audio = new Audio(jsvar);
                            audio.play();
                        }
                        
                    </script>

                        <svg class="sound-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-volume-up" viewBox="0 0 16 16" id="btn">
                            <path d="M11.536 14.01A8.473 8.473 0 0 0 14.026 8a8.473 8.473 0 0 0-2.49-6.01l-.708.707A7.476 7.476 0 0 1 13.025 8c0 2.071-.84 3.946-2.197 5.303l.708.707z"/>
                            <path d="M10.121 12.596A6.48 6.48 0 0 0 12.025 8a6.48 6.48 0 0 0-1.904-4.596l-.707.707A5.483 5.483 0 0 1 11.025 8a5.483 5.483 0 0 1-1.61 3.89l.706.706z"/>
                            <path d="M10.025 8a4.486 4.486 0 0 1-1.318 3.182L8 10.475A3.489 3.489 0 0 0 9.025 8c0-.966-.392-1.841-1.025-2.475l.707-.707A4.486 4.486 0 0 1 10.025 8zM7 4a.5.5 0 0 0-.812-.39L3.825 5.5H1.5A.5.5 0 0 0 1 6v4a.5.5 0 0 0 .5.5h2.325l2.363 1.89A.5.5 0 0 0 7 12V4zM4.312 6.39 6 5.04v5.92L4.312 9.61A.5.5 0 0 0 4 9.5H2v-3h2a.5.5 0 0 0 .312-.11z"/>
                        </svg>
                    </button>
                    </strong>

                    <script type="text/javascript">

                        function correctAnswer(){
                            var el = document.querySelector('#alternative-1');

                            var value = el.innerHTML;

                            <?php
                                $one_sql = "SELECT validacao FROM alternativa WHERE pronuncia = '" . $pronuncias[($actual * 2) + $order[0]] . "'";
                                
                                $one_result = $connection->query($one_sql);

                                $one_data = mysqli_fetch_assoc($one_result);

                                $confirm = $one_data['validacao'];

                                echo "var confirm = '$confirm'";

                            ?>

                            if(confirm == 'yes'){
                                
                                var alert = document.querySelector('#alert');

                                alert.style.display = 'block'
                            } else {
                                var alert = document.querySelector('#alert-2');

                                alert.style.display = 'block'
                            }

                        }

                        function correctAnswer2(){
                            var el = document.querySelector('#alternative-2');

                            var value = el.innerHTML;

                            <?php
                                $one_sql = "SELECT validacao FROM alternativa WHERE pronuncia = '" . $pronuncias[($actual * 2) + $order[1]] . "'";
                                
                                $one_result = $connection->query($one_sql);

                                $one_data = mysqli_fetch_assoc($one_result);

                                $confirm = $one_data['validacao'];

                                echo "var confirm = '$confirm'";

                            ?>

                            if(confirm == 'yes'){
                                
                                var alert = document.querySelector('#alert');

                                alert.style.display = 'block'
                            } else {
                                var alert = document.querySelector('#alert-2');

                                alert.style.display = 'block'
                            }

                        }
                    </script>

                <!--Botões-->
                <div class="container my-3">
                    <button id="alternative-1" type="button" class="btn btn-outline-info" onclick="correctAnswer()">

                    <?php
                    echo $pronuncias[($actual * 2) + $order[0]];
                    ?>
                        
                    </button>
                    <button id="alternative-2" type="button" class="btn btn-outline-info" onclick="correctAnswer2()">
                        
                    <?php
                    echo $pronuncias[($actual * 2) + $order[1]];
                    ?>
                    
                    </button>
                </div>

                <!--Alerta-->
                <div id="alert" class="container my-3">
                    <div class="alert alert-success">
                        <strong>Success!</strong> Correct Answer!
                    </div>
                </div>
                <div id="alert-2" class="container my-3">
                    <div class="alert alert-danger">
                        <strong>Opss!</strong> Wrong Answer!
                    </div>
                </div>
            </div>
        </div>
</body>
</html>