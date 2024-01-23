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

<h2> Api Backend</h2>

- pasta onde fica a api backend:
cd /laravel-rest-api/<br>

- gerar bd e tabelas:
php artisan migrate<br>

- preencher tabela de fases:
file /fill_table_fases.json

- inicializar o servidor: 
php artisan serve

- acessar a url pelo navegador:
http://localhost:8000/

<h2 id="routes">📍 API Endpoints</h2>

arquivos com endpoints e exemplos de requisições
/insomnia/Insomnia_2024-01-22.json

- http://localhost:8000/api/v1/campeonatos
- http://localhost:8000/api/v1/times
- http://localhost:8000/api/v1/fases
- (index e store)

<h2> Frontend</h2>

- Fiz uma parte de Frontend com Boostrap/Vite e login social com github e facebook <br>
na pasta: cd /laravel-rest-api/<br>
rodar o comando: npm run dev<br>
- acessar a url pelo navegador:<br>
http://localhost:8000/

- Tentei inicializar um projeto separado do react para integrar com a api (não finalizado)<br>
cd /react-app<br>
npm start<br>

acessar a url pelo navegador:<br>
http://localhost:3000/<br>



