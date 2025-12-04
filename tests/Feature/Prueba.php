<?php

test('la página principal carga correctamente', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});