const highScoresList = document.getElementById("highScoresList");
const highScores = JSON.parse(localStorage.getItem("highScores")) || [];

highScoresList.innerHTML = highScores
  .map((score, index) => {
    return  `<tr>
                <th scope="row">${index + 1}</th>
                <td>${score.name}</td>
                <td>${score.score}</td>
              </tr>`;
  })
  .join("");

 