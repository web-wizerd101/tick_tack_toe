<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tic Tac Toe</title>
<style>
    .container {
        text-align: center;
        margin-top: 50px;
    }

    .board {
        display: inline-block;
        border: 2px solid #000;
    }

    .row {
        display: flex;
    }

    .cell {
        width: 100px;
        height: 100px;
        border: 1px solid #000;
        cursor: pointer;
        font-size: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: white;
    }

    button {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }
    body {
        overflow-x: hidden;
        overflow-y: hidden;
    }
    .background-image {
    background-image: url('https://imgs.search.brave.com/65bpumdBuVJvNEA-I5DLO7wNeuTjWGMx46NlVed4-hI/rs:fit:860:0:0/g:ce/aHR0cHM6Ly90NC5m/dGNkbi5uZXQvanBn/LzAzLzM2LzQ5LzQ1/LzM2MF9GXzMzNjQ5/NDU1MV9ZYkxIMjlI/M0Z3ZW9zQlBJMUR3/eUZxT3o2czZObHpa/QS5qcGc'); /* Replace 'path/to/your/image.jpg' with the path to your image */
    background-size: cover; /* Cover the entire element with the background image */
    background-position: center; /* Center the background image */
    height: 100vh; /* Set the height of the element to fill the viewport height */
}
</style>
</head>
<body>
<div class="background-image">
<div class="container">
    <br><br>
    <center><h1>Tic Tac Toe</h1></center>
    <center>
    <div class="board">
        <div class="row">
            <div class="cell" id="cell_0"></div>
            <div class="cell" id="cell_1"></div>
            <div class="cell" id="cell_2"></div>
        </div>
        <div class="row">
            <div class="cell" id="cell_3"></div>
            <div class="cell" id="cell_4"></div>
            <div class="cell" id="cell_5"></div>
        </div>
        <div class="row">
            <div class="cell" id="cell_6"></div>
            <div class="cell" id="cell_7"></div>
            <div class="cell" id="cell_8"></div>
        </div>
    </div>
    </center>
    <br>
    
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentPlayer = 'X';
        var cells = document.querySelectorAll('.cell');
        cells.forEach(function(cell) {
            cell.addEventListener('click', function() {
                if (!cell.textContent) {
                    cell.textContent = currentPlayer;
                    if (checkWin()) {
                        alert(currentPlayer + ' wins!');
                        restart();
                    } else if (checkDraw()) {
                        alert('It\'s a draw!');
                        restart();
                    } else {
                        currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
                        if (currentPlayer === 'O') {
                            makeMove();
                        }
                    }
                }
            });
        });

        function checkWin() {
            var lines = [
                [0, 1, 2], [3, 4, 5], [6, 7, 8],
                [0, 3, 6], [1, 4, 7], [2, 5, 8],
                [0, 4, 8], [2, 4, 6]
            ];
            for (var i = 0; i < lines.length; i++) {
                var [a, b, c] = lines[i];
                if (cells[a].textContent && cells[a].textContent === cells[b].textContent && cells[a].textContent === cells[c].textContent) {
                    return true;
                }
            }
            return false;
        }

        function checkDraw() {
            for (var i = 0; i < cells.length; i++) {
                if (!cells[i].textContent) {
                    return false;
                }
            }
            return true;
        }

        function restart() {
            cells.forEach(function(cell) {
                cell.textContent = '';
            });
            currentPlayer = 'X';
        }

        function makeMove() {
            var bestScore = -Infinity;
            var bestMove;
            for (var i = 0; i < cells.length; i++) {
                if (!cells[i].textContent) {
                    cells[i].textContent = 'O';
                    var score = minimax(cells, 0, false);
                    cells[i].textContent = '';
                    if (score > bestScore) {
                        bestScore = score;
                        bestMove = i;
                    }
                }
            }
            cells[bestMove].textContent = 'O';

            if (checkWin()) {
                alert('AI wins!');
                restart();
            } else if (checkDraw()) {
                alert('It\'s a draw!');
                restart();
            } else {
                currentPlayer = 'X';
            }
        }

        function minimax(cells, depth, isMaximizing) {
            if (checkWin()) {
                return isMaximizing ? -10 + depth : 10 - depth;
            } else if (checkDraw()) {
                return 0;
            }

            if (isMaximizing) {
                var bestScore = -Infinity;
                for (var i = 0; i < cells.length; i++) {
                    if (!cells[i].textContent) {
                        cells[i].textContent = 'O';
                        var score = minimax(cells, depth + 1, false);
                        cells[i].textContent = '';
                        bestScore = Math.max(score, bestScore);
                    }
                }
                return bestScore;
            } else {
                var bestScore = Infinity;
                for (var i = 0; i < cells.length; i++) {
                    if (!cells[i].textContent) {
                        cells[i].textContent = 'X';
                        var score = minimax(cells, depth + 1, true);
                        cells[i].textContent = '';
                        bestScore = Math.min(score, bestScore);
                    }
                }
                return bestScore;
            }
        }
    });
</script>

</body>
</html>
