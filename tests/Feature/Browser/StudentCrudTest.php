<?php

it('has browser/studentcrud page', function () {
    $response = $this->get('/browser/studentcrud');

    $response->assertStatus(200);
});
