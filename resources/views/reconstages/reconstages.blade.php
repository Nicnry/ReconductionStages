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
    <h1>Eleves à reconduire</h1>
    <form method="POST" action="reconstages/reconmade">
        {{ csrf_field() }}
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
                    <th>puces</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($internships as $internship)
                    <tr>
                        <td class="{{ $internship->student['firstname'] }}">Company</td>
                        <td class="{{ $internship->student['firstname'] }}">{{ $internship->beginDate }}</td>
                        <td class="{{ $internship->student['firstname'] }}">{{ $internship->endDate }}</td>
                        <td class="{{ $internship->student['firstname'] }}">{{ $internship->responsible['firstname'] }} {{ $internship->responsible['lastname'] }}</td>
                        <td class="{{ $internship->student['firstname'] }}">{{ $internship->admin['firstname'] }} {{ $internship->admin['lastname'] }}</td>
                        <td class="{{ $internship->student['firstname'] }}">{{ $internship->student['firstname'] }} {{ $internship->student['lastname'] }}</td>
                        <td class="{{ $internship->student['firstname'] }}">{{ $internship->grossSalary }}</td>
                        <td class="{{ $internship->student['firstname'] }}">{{ $internship->contractstate_id }}</td>
                        <td><input class="checkList" name="internshipId-{{ $internship->id }}" value="{{ $internship->id }}" type="checkbox"></td>
                    </tr>
                @endforeach
                {{-- @foreach ($internships as $internship)
                    <tr>
                        <td class="{{ $internship->companyName }}">{{ $internship->companies_id }}</td>
                        <td class="{{ $internship->companyName }}">{{ $internship->beginDate }}</td>
                        <td class="{{ $internship->companyName }}">{{ $internship->endDate }}</td>
                        <td class="{{ $internship->companyName }}">{{ $internship->admin_id }}</td>
                        <td class="{{ $internship->companyName }}">{{ $internship->responsible_id }}</td>
                        <td class="{{ $internship->companyName }}">{{ $internship->grossSalary }}</td>
                        <td class="{{ $internship->companyName }}">{{ $internship->intern_id }}</td>
                        <td class="{{ $internship->companyName }}">{{ $internship->contractstate_id }}</td>
                        <td class="{{ $internship->companyName }}">{{ $internship->companyName }}</td>
                        <td class="{{ strftime("%b %g", strtotime($internship->beginDate)) }}">{{ strftime("%b %g", strtotime($internship->beginDate)) }}</td>
                        <td class="{{ $internship->arespfirstname }}-{{ $internship->aresplastname }}">{{ $internship->arespfirstname }} {{ $internship->aresplastname }}</td>
                        <td class="{{ $internship->irespfirstname }}-{{ $internship->iresplastname }}">{{ $internship->irespfirstname }} {{ $internship->iresplastname }}</td>
                        <td class="{{ $internship->studentfirstname }}-{{ $internship->studentlastname }}">{{ $internship->studentfirstname }} {{ $internship->studentlastname }}</td>
                        <td class="{{ $internship->grossSalary }}">{{ $internship->grossSalary }}</td>
                        <td class="{{ $internship->stateDescription }}">{{ $internship->stateDescription }}</td>
                        <td><input class="checkList" name="internshipId-{{ $internship->id }}" value="{{ $internship->id }}" type="checkbox"></td>
                    </tr>
                @endforeach --}}
            </tbody>
        
        </table>
        <button class="btn btn-primary" id="reconduire" type="submit">Reconduire</button>
        <div class="checkBox"><input type="checkbox" id="check">Select All</div>
    </form>
    

@stop

@section ('page_specific_js')
    <script src="js/reconstages.js"></script>
@stop