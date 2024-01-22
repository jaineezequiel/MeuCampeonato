<h1 align="center" style="font-weight: bold;">Meu Campeonato ⚽</h1>

<p align="center">
 <a href="#tech">Tecnologias</a> • 
 <a href="#started">Getting Started</a> • 
  <a href="#routes">API Endpoints</a> •
</p>

<p align="center">
    Nosso cliente José Gustavo, apaixonado por futebol e tecnologia, deseja ter uma
aplicação que simule os campeonatos de futebol do seu bairro, chamada Meu
Campeonato.
Para isso, considere um sistema eliminatório que inicia-se nas quartas de final:
oito times participam do campeonato;
o perdedor de cada jogo é eliminado do campeonato;
na primeira fase (quartas de final) quatro jogos são sorteados, sendo que cada
time joga apenas uma vez;
na segunda fase (semifinais) dois jogos são sorteados, sendo que cada time
joga apenas uma vez;
os perdedores das semifinais disputam o 3º lugar;
a final é disputada pelos vencedores das semifinais, definindo o 1º e 2º lugar do
campeonato;
em caso de empate, considere como vencedor o time com a maior pontuação
(acumulada desde o início do campeonato):
para cada gol marcado, o time recebe 1 ponto;
para cada gol sofrido, o time perde 1 ponto;
Teste técnico: full stack 3
em caso de novo empate, considere como vencedor o time que foi inscrito
primeiro no campeonato;
o placar de cada jogo pode ser gerado randomicamente pelo back-end ou por
uma rotina em Python, como detalhado no tópico a seguir.
</p>

<h2 id="Tecnologias">💻 Tecnologias</h2>

- Laravel
- React
- Mysql
- Git

<h2 id="started">🚀 Getting started</h2>

git clone https://github.com/jaineezequiel/MeuCampeonato.git
<br>
cd /laravel-rest-api/<br>
php artisan migrate<br>
php artisan serve

cd /react-app<br>
npm start


<h2 id="routes">📍 API Endpoints</h2>

