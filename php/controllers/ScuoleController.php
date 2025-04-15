<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

Class ScuoleController{

    //get di tutti
    public function index(Request $request, Response $response, $args){
        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $result = $mysqli_connection->query("SELECT * FROM scuole");
        $result = $result->fetch_all(MYSQLI_ASSOC);  

        if(!empty($result)){
            $response->getBody()->write(json_encode($result));
            return $response->withHeader("Content-type", "application/json")->withStatus(200);
        }else{
            $response->getBody()->write("Nessuna scuola presente");
            return $response->withHeader("Content-type", "application/json")->withStatus(404);
        }
    }

    //get con id
    public function view(Request $request, Response $response, $args){
        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $result = $mysqli_connection->query('SELECT * FROM scuole WHERE id=' . $args["id"] .'');
        $result = $result->fetch_all(MYSQLI_ASSOC);

        if(!empty($result)){
            $response->getBody()->write(json_encode($result));
            return $response->withHeader("Content-type", "application/json")->withStatus(200);
        }else{
            $response->getBody()->write("Scuola non trovata");
            return $response->withHeader("Content-type", "application/json")->withStatus(404);
        }

    }

    //create
    public function create(Request $request, Response $response, $args){
        $data = json_decode($request->getBody()->getContents(), true);
        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $stmt = $mysqli_connection->prepare("INSERT INTO scuole (nome, indirizzo) VALUES (?, ?)");
        $stmt->bind_param("ss", $data['nome'], $data['indirizzo']);
        $stmt->execute();

        $response->getBody()->write($data["nome"]);
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }

    //update
    public function update(Request $request, Response $response, $args){
        $data = json_decode($request->getBody()->getContents(), true);
        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $stmt = $mysqli_connection->prepare("UPDATE scuole SET nome = ?, indirizzo = ? where id = ?");
        $stmt->bind_param("ssi", $data['nome'], $data['indirizzo'], $data['id']);
        $stmt->execute();

        $response->getBody()->write($data["nome"]);
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }

    //destroy
    public function destroy(Request $request, Response $response, $args){
        $data = json_decode($request->getBody()->getContents(), true);
        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $stmt = $mysqli_connection->prepare("DELETE FROM scuole WHERE id = ?;");
        $stmt->bind_param("i", $data['id']);
        $stmt->execute();

        $response->getBody()->write("+1 KILL");
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }

}

?>