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
        <thead>
            <tr>
                <th>Entreprise</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Responsable administratif</th>
                <th>Responsable</th>
                <th>Stagiaire</th>
                <th>Salaire</th>
                <th>Etat</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($last as $value)
            <!-- Les données sont reprises tel que sur la page précédentes mais on y affiche uniquement ceux qui on été traité sur la page précédente. -->
                <tr class="{{ strtolower($value->student->initials) }}">
                    <td>{{ $value->companie->companyName }}</td>
                    <td>{{ $value->beginDate }}</td>
                    <td>{{ $value->endDate }}</td>
                    <td>{{ $value->responsible->firstname }} {{ $value->responsible->lastname }}</td>
                    <td>{{ $value->admin->firstname }} {{ $value->admin->lastname }}</td>
                    <td>{{ $value->student->firstname }} {{ $value->student->lastname }}</td>
                    <td>{{ $value->grossSalary }}</td>
                    <td>{{ $value->contractstate->stateDescription }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Reconduction effectuée de :</h2>

    <table class="reconduit">
        <tr>
            <th>Entreprise</th>
            <th>Stagiaire</th>
        </tr>
        
    @foreach ($selected as $internship)
    <!-- Les données sont reprises tel que sur la page précédentes mais on y affiche uniquement ceux qui on été traité sur la page précédente. -->
        <tr>
            <td class="{{ $internship->companyName }}">{{ $internship->companie->companyName }}</td>
            <td class="{{ $internship->studentfirstname }}-{{ $internship->studentlastname }}">{{ $internship->student->firstname }} {{ $internship->student->lastname }}</td>
            <td>{{ $internship->beginDate }}</td>
            <td>{{ $internship->endDate }}</td>
        </tr>
    @endforeach
    </table>
    <a href="/"><button class="btn btn-default">Retour à la page d'accueil</button></a>
@stop
