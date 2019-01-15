<!--
// Nicolas Henry
// SI-T1a
// reconmade.blade.php
-->
@extends ('layout')

@section ('page_specific_css')
    <link rel="stylesheet" type="text/css" href="/css/documents.css">
@stop

@section ('content')
    <a href="/reconstages">Reconduction page</a>
    <h1>Nouvelles données :</h1>

    <table class="reconduction">
        <tr>
            <th>Entreprise</th>
            <th>Stagiaire</th>
        </tr>
        {{-- @foreach ($reconductible as $internship)
        <!-- Les données sont reprises tel que sur la page précédentes mais on y affiche uniquement ceux qui on été traité sur la page précédente. -->
            <tr>
                <td class="{{ $internship->companyName }}">{{ $internship->companie->companyName }}</td>
                <td class="{{ $internship->studentfirstname }}-{{ $internship->studentlastname }}">{{ $internship->student->firstname }} {{ $internship->student->lastname }}</td>
            </tr>
        @endforeach --}}
    </table>

    <h2>Reconduction effectuée de :</h2>

    <table class="reconduit">
        <tr>
            <th>Entreprise</th>
            <th>Stagiaire</th>
        </tr>
        
    @foreach ($reconductible as $internship)
    <!-- Les données sont reprises tel que sur la page précédentes mais on y affiche uniquement ceux qui on été traité sur la page précédente. -->
        <tr>
            <td class="{{ $internship->companyName }}">{{ $internship->companie->companyName }}</td>
            <td class="{{ $internship->studentfirstname }}-{{ $internship->studentlastname }}">{{ $internship->student->firstname }} {{ $internship->student->lastname }}</td>
        </tr>
    @endforeach
    </table>
    <a href="/"><button class="btn btn-default">Retour à la page d'accueil</button></a>
@stop
