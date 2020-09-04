<?php

return function () use ($app) {

    $app->post('/', function ($request, $response) {
        $data = $request->getParsedBody();
        $id = $data["id"];
        $field1 = $data["field1"];
        $field2 = $data["field2"];
        
        $sql = "INSERT INTO `table2` (`id`, `field1`, `field2`) VALUES ($id, '$field1', '$field2'); ";
        if (mysqli_query($this->db, $sql))
            $response->getBody()->write("success");
        else
            $response->getBody()->write("failed " . mysqli_error($this->db));

        return $response;
    });

    $app->get('/', function ($request, $response, $args) {
        $sql = "select * from `table2`;";
        $result = $this->db->query($sql);

        $out = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $response->withJson($out);
    });

    $app->get('/{id}', function ($request, $response, $args) {
        $id = (int)$args["id"];
        $sql = "select * from `table2` where `id` = {$id};";
        $result = $this->db->query($sql);

        $out = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $response->withJson($out);
    });

    $app->put('/id/{$id}/field2', function ($request, $response, $args) {
        $id = (int)$args["id"];

        $data = $request->getParsedBody();

        $field1 = $data["field1"];
        $field2 = $data["field2"];

        $sql = "UPDATE `table2` SET `field1` = '$field1', `field2` = '$field2' WHERE `table2`.`id` = $id";
        if (mysqli_query($this->db, $sql))
            $response->getBody()->write("success");
        else
            $response->getBody()->write("failed " . mysqli_error($this->db));

        return $response;
    });

    $app->delete('/{id}', function ($request, $response, $args) {
        $id = (int)$args["id"];
        $sql = "DELETE FROM `table2` WHERE `table2`.`id` = $id; ";
        if (mysqli_query($this->db, $sql))
            $response->getBody()->write("success");
        else
            $response->getBody()->write("failed " . mysqli_error($this->db));

        return $response;
    });
};
