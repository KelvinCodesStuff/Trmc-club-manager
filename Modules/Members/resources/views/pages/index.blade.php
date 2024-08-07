@extends('admin::layouts.master')

@section('title', 'Leden')

@section('content')
  <div class="container-fluid">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <div class="container bootstrap mt-4 pl-0">
      <div class="row mt-3 mb-4">
        <div class="col-sm  ml-2 mr-2 text-center text-white">
          <h3>Aantal ingeschreven</h3>
          <h1>{{ $AllMembers ?? 0 }}</h1>
        </div>

        <div class="col-sm  ml-2 mr-2 text-center text-white">
          <h3>Aantal leden</h3>
          <h1>{{ $totalNormalMembers + $totalManagement + $totalAspirantMember ?? 0 }}</h1>        
        </div>

        <div class="col-sm  ml-2 mr-2 text-center text-white">
          <h3>Aantal donateurs</h3>
          <h1>{{ $totalDonators ?? 0 }}</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="main-box no-header clearfix bg-dark bg-opacity-50">
            <div class="row">
              <div class="col ml-2">
                <div class="w-25 float-start mb-4 ms-4">
                  <input type="text" id="name_search" onkeyup="nameFilter()" placeholder="Zoek naam" class="form-control rounded">
                </div>
              </div>  

              <div class="col mr-2">
                <div class="w-25 mb-4 me-4 float-end">
                  <select class="form-control form-control-lg" id="clubstatus_filter" onchange="clubStatusFilter()">
                    <option value="All" selected>Alle club statussen</option>
                    <option value="Jeugdlid">Jeugd lid</option>
                    <option value="Aspirantlid">Aspirant lid</option>
                    <option value="Lid">Lid</option>
                    <option value="Bestuur">Bestuur</option>
                    <option value="Donateur">Donateur</option>
                    <option value="Noggeenlid">Nog geen lid</option>
                    <option value="Nieuweaanmelding">Nieuwe aanmeldingen</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="main-box-body clearfix">
              <div class="table-responsive">
                <table class="table user-list" id="MembersTable">
                  <thead class="text-white">
                    <tr>
                      <th><span>Icoon</span></th>
                      <th><span>Vol. naam</span></th>
                      <th><span>KNVvl</span></th>
                      <th class="text-center"><span>Club status</span></th>
                      <th><span>RDW nmr.</span></th>
                      <th><span>Telefoon</span></th>
                      <th><span>Email</span></th>
                      <th>Open, bewerk, verwijder</th>
                    </tr>
                  </thead>
                  <tbody class="text-white">
                    @foreach ($members as $member)
                      <tr>
                        <!-- Icons -->
                        <td>
                          @if ($member->in_memoriam == 1)
                            <img src="/media/images/icons/ribbon.png" alt="" style="width: 35px" class="img-fluid ms-2">
                          @elseif ($member->has_plane_brevet || $member->has_helicopter_brevet || $member->has_glider_brevet)
                            <img src="/media/images/icons/quality.png" alt="" style="width: 35px" class="img-fluid ms-2">
                          @else
                            <img src="/media/images/icons/user.png" alt="" style="width: 35px" class="img-fluid ms-2">
                          @endif
                        </td>
                        <!-- User -->
                        <td>
                        {{ $member->name ?? 'Niet ingevuld' }}
                        </td>
                        <!-- KNVvl -->
                        <td>{{ $member->KNVvl ?? 'Niet ingevuld'}}</td>
                        <!-- Club status -->
                        @if ($member->club_status == \Modules\Members\Enums\ClubStatus::JUNIOR_MEMBER->value)
                          <td class="text-center">
                            <span class="badge badge-pill bg-success" style="font-size: 1rem;">Jeugd lid</span>
                          </td>
                        @elseif ($member->club_status == \Modules\Members\Enums\ClubStatus::ASPIRANT_MEMBER->value)
                          <td class="text-center">
                            <span class="badge badge-pill bg-info" style="font-size: 1rem;">Aspirant lid</span>
                          </td>
                        @elseif ($member->club_status == \Modules\Members\Enums\ClubStatus::MEMBER->value)
                          <td class="text-center">
                            <span class="badge badge-pill bg-primary" style="font-size: 1rem;">Lid</span>
                          </td>
                        @elseif ($member->club_status == \Modules\Members\Enums\ClubStatus::MANAGEMENT->value)
                          <td class="text-center">
                            <span class="badge badge-pill bg-warning" style="font-size: 1rem;">Bestuur</span>
                          </td>
                        @elseif ($member->club_status == \Modules\Members\Enums\ClubStatus::DONOR->value)
                          <td class="text-center">
                            <span class="badge badge-pill bg-secondary" style="font-size: 1rem;">Donateur</span>
                          </td>
                        @elseif ($member->club_status == \Modules\Members\Enums\ClubStatus::NOT_YET_MEMBER->value)
                          <td class="text-center">
                            <span class="badge badge-pill bg-danger" style="font-size: 1rem;">Nog geen lid</span>
                          </td>
                        @elseif ($member->club_status == \Modules\Members\Enums\ClubStatus::NEW_REGISTRATION->value)
                          <td class="text-center">
                            <span class="badge badge-pill bg-danger" style="font-size: 1rem;">Nieuwe aanmelding</span>
                          </td>                          
                        @endif        
                        <!-- RDW number -->
                        <td>{{ $member->rdw_number ?? 'Niet ingevuld' }}</td>                    
                        <!-- Phone number -->
                        <td>{{ $member->phone ?? 'Niet ingevuld' }}</td>
                        <!-- Email -->
                        <td>
                          <a href="#">{{ $member->email ?? 'Niet ingevuld' }}</a>
                        </td>
                        <!-- View, edit, delete buttons -->
                        <td style="width: 20%;">
                          <a href="#" class="table-link text-warning" data-toggle="modal" data-target="#modal{{ $member->id }}">
                            <span class="fa-stack" style="font-size: 1rem;">
                              <i class="fa fa-square fa-stack-2x"></i>
                              <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                            </span>
                          </a>
                          <a href="{{ route('members.edit', $member->id) }}" class="table-link text-info">
                            <span class="fa-stack" style="font-size: 1rem;">	
                              <i class="fa fa-square fa-stack-2x"></i>
                              <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                            </span>
                          </a>
                          <a href="leden/verwijder/{{ $member->id }}" class="table-link danger" onclick="return confirm('Weet je zeker dat je gebruiker {{ $member->name }} wilt verwijderen?');">
                            <span class="fa-stack" style="font-size: 1rem;">
                              <i class="fa fa-square fa-stack-2x"></i>
                              <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                            </span>
                          </a>
                        </td>
                      </tr>
                    @endforeach               
                  </tbody>
                </table
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  @foreach ($members as $member)
    <!-- Modal -->
    <div class="modal fade" id="modal{{ $member->id }}" tabindex="-1" role="dialog" aria-labelledby="modal{{ $member->id }}" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Info van {{ $member->name }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <h4>Persoonlijke gegevens:</h4>
                <p class="">
                  <strong>Naam:</strong> {{ $member->name }}<br>
                  <strong>Geboortedatum:</strong> {{ $member->birthdate }}<br>
                  <strong>Adres:</strong> {{ $member->address }}<br>
                  <strong>Postcode:</strong> {{ $member->postcode }}<br>
                  <strong>Stad:</strong> {{ $member->city }}<br>
                </p>
              </div>

              <hr>

              <div class="col-md-12">
                <h4>Brevetten:</h4>
                <p class="fw-bold">
                  Motorvliegtuig:
                  @if ($member->has_plane_brevet == 1)
                    <span class="badge rounded-pill bg-success">Ja</span>
                  @else
                    <span class="badge rounded-pill bg-danger">Nee</span>
                  @endif

                  <br>
                  Helicopter:
                  @if ($member->has_helicopter_brevet == 1)
                    <span class="badge rounded-pill bg-success">Ja</span>
                  @else
                    <span class="badge rounded-pill bg-danger">Nee</span>
                  @endif
                  <br>
                  Zweefvliegtuig:
                  @if ($member->has_glider_brevet == 1)
                    <span class="badge rounded-pill bg-success">Ja</span>
                  @else
                    <span class="badge rounded-pill bg-danger">Nee</span>
                  @endif
                </p>
              </div>

              <hr>

              <div class="col-md-12">
                <h4>Drone certificaten:</h4>
                <p class="">
                  <strong>A1:</strong>
                  @if ($member->has_drone_a1 == 1)
                    <span class="badge rounded-pill bg-success">Ja</span>
                  @else
                    <span class="badge rounded-pill bg-danger">Nee</span>
                  @endif

                  <strong>A2:</strong>
                  @if ($member->has_drone_a2 == 1)
                  <span class="badge rounded-pill bg-success">Ja</span>
                  @else
                    <span class="badge rounded-pill bg-danger">Nee</span>
                  @endif

                  <strong>A3:</strong>
                  @if ($member->has_drone_a3 == 1)
                    <span class="badge rounded-pill bg-success">Ja</span>
                  @else
                    <span class="badge rounded-pill bg-danger">Nee</span>
                  @endif                                    
              </div>

              <hr>

              <div class="col-md-12">
                <h4>Overig:</h4>
                <p class="">
                  <strong>Erelid:</strong>
                  @if ($member->in_memoriam == 1)
                    <span class="badge badge-pill bg-success">Ja</span>
                  @else
                    <span class="badge badge-pill bg-danger">Nee</span>
                  @endif
                </p>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluit</button>
          </div>
        </div>
      </div>
    </div>
  @endforeach

  <style>
    body{
        background:#eee;    
    }
    .main-box.no-header {
        padding-top: 20px;
    }
    .main-box {
        -webkit-box-shadow: 1px 1px 2px 0 #CCCCCC;
        -moz-box-shadow: 1px 1px 2px 0 #CCCCCC;
        -o-box-shadow: 1px 1px 2px 0 #CCCCCC;
        -ms-box-shadow: 1px 1px 2px 0 #CCCCCC;
        box-shadow: 1px 1px 2px 0 #CCCCCC;
        margin-bottom: 16px;
        -webikt-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
    .table a.table-link.danger {
        color: #e74c3c;
    }
    .label {
        border-radius: 3px;
        font-size: 0.875em;
        font-weight: 600;
    }
    .user-list tbody td .user-subhead {
        font-size: 0.875em;
        font-style: italic;
    }
    .user-list tbody td .user-link {
        display: block;
        font-size: 1.25em;
        padding-top: 3px;
        margin-left: 0px;
    }
    a {
        color: #ffffff;
        outline: none!important;
    }
    .user-list tbody td>img {
        position: relative;
        max-width: 50px;
        float: left;
        margin-right: 15px;
    }

    .table thead tr th {
        text-transform: uppercase;
        font-size: 0.875em;
    }
    .table thead tr th {
    }
    .table tbody tr td:first-child {
        font-size: 1.125em;
        font-weight: 300;
    }
    .table tbody tr td {
        font-size: 0.875em;
        vertical-align: middle;
        border-top: 1px solid #e7ebee;
        padding: 2px 2px;
    }
    a:hover{
    text-decoration:none;
    }
  </style>

  <script>
    function nameFilter() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("name_search");
      filter = input.value.toUpperCase();
      table = document.getElementById("MembersTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }

    function clubStatusFilter() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("clubstatus_filter");
      table = document.getElementById("MembersTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];

        if (td) {
          txtValue = td.textContent || td.innerText;

          if (input.value.replace(/\s/g,'') === txtValue.replace(/\s/g,'')) {
            tr[i].style.display = "";
          } else if (input.value.replace(/\s/g,'') === 'All') {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  </script>
@endsection
