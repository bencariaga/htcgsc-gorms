<?php

it('has browser/appointmentcrud page', function () {
    $response = $this->get('/browser/appointmentcrud');

    $response->assertStatus(200);
});
