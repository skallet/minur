<h1>Seznam turnajů</h1>

<table class="table table-striped table-hover">
    <tr>
        <th>Název turnaje</th>
        <th>Od</th>
        <th>Do</th>
        <th>&nbsp;</th>
    </tr>

    <tr>
        <td>
            <a href="?s=tournament-view">Název</a>
        </td>
        <td>
            18. 6. 2015
        </td>
        <td>
            21. 6. 2015
        </td>
        <td>
            iff date() < deadline and logged-in-team not in tournament.teams then <a href="#" onclick="return confirm('Opravdu si přejete přihlásit Váš tým do turnaje?');" class="btn btn-success">Pihlásit tým</a><br>
            else if kigged-in-team in tournament.teams then: <span class="label label-success">Tým přihlášen</span>
            else iff date() >= start && date() <= end then probíhá<br>
            else iff date() > end the odehráno<br>
            else &nbsp;
        </td>
    </tr>
</table>