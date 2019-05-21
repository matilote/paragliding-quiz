const username = document.getElementById('username');
const saveResultBtn = document.getElementById('saveResult');
const finalScore = document.getElementById('finalScore')
const mostRecentScore = localStorage.getItem('mostRecentScore')
finalScore.innerText = `Twój wynik: ${mostRecentScore}`;

const maxHighScore = 10;
const highScore = JSON.parse(localStorage.getItem("highScores")) || [];
console.log(highScore)

username.addEventListener('keyup', () => {
    saveResultBtn.disabled = !username.value;
})

saveHighScore = event => {
    event.preventDefault();

    const score = {
        score: mostRecentScore[0],
        name: username.value
    };
    highScore.push(score);
    highScore.sort( (a, b) => {
        return b.score - a.score
    });
    highScore.splice(maxHighScore);
    localStorage.setItem('highScores', JSON.stringify(highScore))
    window.location.assign("index.html")
}