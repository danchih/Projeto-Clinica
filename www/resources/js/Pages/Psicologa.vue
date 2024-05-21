<template>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
      <h1 class="text-3xl font-bold mb-8">Área do Psicólogo(a)</h1>
      <div class="mt-8">
        <a href="/listapaciente" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-2">Lista de Pacientes</a>
        <a href="/documentos" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-2">Documentos</a>
      </div>
    </div>
  </template>
  
  <style>
    .min-h-screen {
      min-height: 100vh;
    }
    .btn {
      transition: all 0.3s;
    }
    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
  </style>