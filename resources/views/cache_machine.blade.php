<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cache Machine</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
            }

            .content {
                padding: 30px;
                margin-left: 20px;
            }

            .input {
                width: 200px;
                height: 25px;
                border-radius: 3px;
            }

            .mt-3 {
                margin-top: 30px;
            }

        </style>
    </head>
    <body>
        <div id="app" class="content">
            <form action="/" method="POST">
                @csrf
                <div>
                    <label for="addAvailableMoneyBulls">Adicionar Notas Disponíveis:</label></br>
                    <input type="number" min="1" id="addAvailableMoneyBulls" class="input">
                    <button id="btnAdd">+</button>
                    <input type="text" style="display: none" id="availableNotes" name="availableNotes">
                    </br></br>
                    <label for="notes">
                        Notas disponíveis: 
                        <span id="availableMoney"></span>
                    </label>
                </div>

                <div class="mt-3">
                    <label for="withdrawalAmount">Saque:</label></br>
                    <input type="number" name="withdrawalAmount" placeholder="Valor do saque" min="1" id="withdrawalAmount" class="input">
                </div>

                <input type="submit" value="Gerar notas" class="input" style="margin-top: 20px">

                <div class="mt-3">
                    <span>{{ $notes ?? '' }}</span>
                </div>
            </form>  
        </div>

        <script>
            let availableMoneyBulls = [];

            document.getElementById('btnAdd').addEventListener('click', function(event) {
                event.preventDefault();
                addAvailableMoneyBulls();
            })

            function addAvailableMoneyBulls() {
                const availableMoney = document.getElementById('addAvailableMoneyBulls').value;

                if (availableMoney && !availableMoneyBulls.includes(availableMoney)) {
                    availableMoneyBulls.push(availableMoney);
                    document.getElementById('availableNotes').value = availableMoneyBulls;
                    document.getElementById('availableMoney').innerHTML = availableMoneyBulls.join(',');
                }
            }

        </script>
    </body>
</html>

