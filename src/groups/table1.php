<?php

return function () use ($app) {
    $app->get('/', function ($request, $response, $args) {
        $sql = "select * from `table1`;";
        $result = $this->db->query($sql);

        $out = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $response->withJson($out);
    });
    $app->post('/', function ($request, $response) {
        $data = $request->getParsedBody();

        $field1 = $data['field2'];
        $timestamp = (new DateTime())->getTimestamp();
        $field2 = $data['field2'];
        $field3 = $data['field3'];

        $sql = "INSERT INTO `table1` (`id`, `field1`, `timestamp`, `field2`, `field3`) VALUES (NULL, '$field1', '$timestamp', '$field2', '$field3')";
        if (mysqli_query($this->db, $sql))
            $response->getBody()->write("success");
        else
            $response->getBody()->write("failed " . mysqli_error($this->db));

        return $response;
    });
};
