<?php

it('has browser/usercrud page', function () {
    $response = $this->get('/browser/usercrud');

    $response->assertStatus(200);
});
