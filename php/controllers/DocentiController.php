<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DocentiController
{
  //get con id
  public function view(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM docenti where scuola_id = " .$args['scuola_id']);
    $result = $result->fetch_all(MYSQLI_ASSOC);

    if(!empty($result)){
      $response->getBody()->write(json_encode($result));
      return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }else{
      $response->getBody()->write("Scuola senza docenti");
      return $response->withHeader("Content-type", "application/json")->withStatus(404);
    }
  }

  //get singolo docente
  public function search(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query('SELECT * FROM docenti WHERE id=' . $args["id"] .'');
    $result = $result->fetch_all(MYSQLI_ASSOC);

    if(!empty($result)){
      $response->getBody()->write(json_encode($result));
      return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }else{
      $response->getBody()->write("Docente non trovato");
      return $response->withHeader("Content-type", "application/json")->withStatus(404);
    }
  }

  //create
  public function create(Request $request, Response $response, $args){
    $data = json_decode($request->getBody()->getContents(), true);
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $stmt = $mysqli_connection->prepare("INSERT INTO docenti (nome, cognome, scuola_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $data['nome'], $data['cognome'], $data['scuola_id']);
    $stmt->execute();

    $response->getBody()->write($data["nome"]);
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  //update
  public function update(Request $request, Response $response, $args){
    $data = json_decode($request->getBody()->getContents(), true);
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $stmt = $mysqli_connection->prepare("UPDATE docenti SET nome = ?, cognome = ? where id = ?");
    $stmt->bind_param("ssi", $data['nome'], $data['cognome'], $data['id']);
    $stmt->execute();

    $response->getBody()->write($data["nome"]);
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  //destroy
  public function destroy(Request $request, Response $response, $args){
    $data = json_decode($request->getBody()->getContents(), true);
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $stmt = $mysqli_connection->prepare("DELETE FROM docenti WHERE id = ?;");
    $stmt->bind_param("i", $data['id']);
    $stmt->execute();
    $response->getBody()->write("+1 KILL");
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

}
?>