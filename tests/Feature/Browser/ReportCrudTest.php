<?php

it('has browser/reportcrud page', function () {
    $response = $this->get('/browser/reportcrud');

    $response->assertStatus(200);
});
