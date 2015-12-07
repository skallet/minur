<h1>Dream team vs FIT</h1>
<h2>Název turnaje (turnaj.od turnaj.do)</h2>

<h3>Datum a čas</h3>
<p>Pomocí tlačítka + můžete přidat návrh termínu. Po kliknutí na vlastní návrh jej můžete editovat.
Po kliknutí na návrh soupeře jej můžete odsouhlasit.</p>

<style>
    .terms td{
        padding-top: 1px !important;
        padding-bottom: 1px !important;;
    }
</style>

<table class="table">
    <tr>
        <th>Po 4. 4</th>
        <th>Po 5. 4</th>
        <th>Po 6. 4</th>
        <th>Po 7. 4</th>
        <th>Po 8. 4</th>
        <th>Po 9. 4</th>
        <th>Ne 10. 4</th>
    </tr>
    <tr>
        <td class="table-bordered" style="padding:0">
            <table class="table terms table-hover">
                <tr class="warning"><td
                    data-toggle="popover" data-content="
                        <table class='table'><tr class='warning'><th>Čas</th><td>
                        16.30 - 20.30
                        </td></tr><tr class='warning'><th>Míst</th><td>
                        Stromovka
                        </td></tr><tr class='warning'><td colspan='100'>&nbsp;</td></tr><tr class='warning'><th>Zadal</th><td>
                        DREAM TEAM
                        </td></tr><tr class='warning'><th>Počet hráčů</th><td>
                        12
                        </td></tr></table>
                        <a href='' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span> Smazat</a>
                        <a href='' class='btn btn-warning'><span class='glyphicon glyphicon-pencil'></span> Upravit</a>
                        "
                    >9.00 - 12.00</td></tr>
                <tr class="info"><td
                        data-toggle="popover" data-content="
                        <table class='table'><tr class='info'><th>Čas</th><td>
                        16.30 - 20.30
                        </td></tr><tr class='info'><th>Míst</th><td>
                        Stromovka
                        </td></tr><tr class='info'><td colspan='100'>&nbsp;</td></tr><tr class='info'><th>Zadal</th><td>
                        DRUHEJ DREAM TEAM
                        </td></tr><tr class='info'><th>Počet hráčů</th><td>
                        12
                        </td></tr></table>
                        <a href='' class='btn btn-success'><span class='glyphicon glyphicon-ok'></span> Potvrdit termín</a>
                        "
                        >9.00 - 12.00</td></tr>
            </table>
            <a href="?s=term-add" class="label label-success pull-right"><big>+</big></a>
        </td>
    </tr>
</table>

<h3>Výsledek</h3>
<table class="table">
    <tr>
        <td class="table-bordered">
            FORM
        </td>
        <td>

        </td>
        <td class="table-bordered">
            souper jeste nezadal, pokud nexadal, jiank vypsat, co tam zadal a pokud nemame jeste zadano
            <a class="btn btn-success btn-lg">Potvrdit soupeřův výsledek</a>
        </td>
    </tr>
</table>


<h3>Komentáře</h3>

FORM vlozit<br>


<hr>
<p><span class="label label-warning">DT</span> <span class="glyphicon glyphicon-calendar"></span> 21. 10. 1998 10.15</p>
<p>
    Ahoj, todle sem napsal já
</p>
<hr>

<p><span class="label label-info">FIT</span> <span class="glyphicon glyphicon-calendar"></span> 21. 10. 1998 10.15</p>
<p>
    A todle my
</p>
<hr>

<script>
    $(function(){
        $('.terms td').popover({
            "html": "on",
            // "trigger": "focus",  proc to nejde vi buh
        });
    });
</script>