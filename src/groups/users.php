<?php

return function () use ($app) {
    // get all users
    $app->get('/', function ($request, $response, $args) {
        $sql = "select * from `users`;";
        $result = $this->db->query($sql);

        $out = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $response->withJson($out);
    });

    // get one user by id
    $app->get('/{id}', function ($request, $response, $args) {
        $id = (int)$args["id"];
        $sql = "select * from `users` where `id` = {$id};";
        $result = $this->db->query($sql);

        $out = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $response->withJson($out);
    });

    // register user
    $app->post('/', function ($request, $response) {
        $data = $request->getParsedBody();

        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];

        $sql = "INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES (NULL, '$name', '$email', '$password')";
        if (mysqli_query($this->db, $sql))
            $response->getBody()->write("success");
        else
            $response->getBody()->write("failed " . mysqli_error($this->db));

        return $response;
    });

    // edit user
    $app->put('/{id}', function ($request, $response, $args) {
        $data = $request->getParsedBody();
        $id = (int)$args["id"];
        $name = $data["name"];
        $email = $data["email"];
        $password = $data["password"];
        $sql = "UPDATE `table3` SET `name` = '$name', `email` = '$email', `password` = '$password' WHERE `users`.`id` = $id";
        if (mysqli_query($this->db, $sql))
            $response->getBody()->write("success");
        else
            $response->getBody()->write("failed " . mysqli_error($this->db));

        return $response;
    });

    // delete user
    $app->delete('/{id}', function ($request, $response, $args) {
        $id = (int)$args["id"];
        $sql = "DELETE FROM `users` WHERE `users`.`id` = $id";
        if (mysqli_query($this->db, $sql))
            $response->getBody()->write("success");
        else
            $response->getBody()->write("failed " . mysqli_error($this->db));

        return $response;
    });

};