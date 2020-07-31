@extends('layouts.app')

@section('content')
  <header-navbar></header-navbar>

  <v-main class="blue-grey lighten-5">
    <v-container fluid >
      <v-row justify="center">
        <v-col cols="12">
          <profile></profile>
        </v-col>
      </v-row>
    </v-container>
  </v-main>
@stop