<?php

return function () use ($app) {
    $app->get('/', function ($request, $response, $args) {
        $sql = "select * from table3;";
        $result = $this->db->query($sql);

        $out = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $response->withJson($out);
    });
    $app->get('/{id}', function ($request, $response, $args) {
        $id = (int)$args["id"];
        $sql = "select * from `table3` where `id` = {$id};";
        $result = $this->db->query($sql);

        $out = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $response->withJson($out);
    });
    $app->get('/field1/{field1}', function ($request, $response, $args) {
        $field1 = $args["field1"];
        $sql = "select * from `table3` where `field1` = {$field1};";
        $result = $this->db->query($sql);

        $out = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $response->withJson($out);
    });
    $app->post('/', function ($request, $response) {
        $data = $request->getParsedBody();
        $field3 = $data["field3"];
        $field2 = $data["field2"];
        $field1 = $data["field1"];
        $timestamp = (new DateTime())->getTimestamp();

        $sql = "INSERT INTO `table3` (`id`, `field3`, `field2`, `field1`, `timestamp`) VALUES (NULL, '$field3', '$field2', '$field1', '$timestamp')";
        if (mysqli_query($this->db, $sql))
            $response->getBody()->write("success");
        else
            $response->getBody()->write("failed " . mysqli_error($this->db));

        return $response;
    });
    $app->put('/{id}', function ($request, $response, $args) {
        $data = $request->getParsedBody();
        $id = (int)$args["id"];
        $field3 = $data["field3"];
        $field2 = $data["field2"];
        $field1 = $data["field1"];
        $sql = "UPDATE `table3` SET `field3` = '$field3', `field2` = '$field2', `field1` = '$field1' WHERE `table3`.`id` = $id";
        if (mysqli_query($this->db, $sql))
            $response->getBody()->write("success");
        else
            $response->getBody()->write("failed " . mysqli_error($this->db));

        return $response;
    });
    
    $app->delete('/{id}', function ($request, $response, $args) {
        $id = (int)$args["id"];
        $sql = "DELETE FROM `table3` WHERE `table3`.`id` = $id";
        if (mysqli_query($this->db, $sql))
            $response->getBody()->write("success");
        else
            $response->getBody()->write("failed " . mysqli_error($this->db));

        return $response;
    });
};
