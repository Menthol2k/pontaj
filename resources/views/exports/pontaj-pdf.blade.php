@php
    function removeDiacritics($string) {
    $diacritics = ['ă','â','î','ș','ț','Ă','Â','Î','Ș','Ț'];
    $replacements = ['a','a','i','s','t','A','A','I','S','T'];
    return str_replace($diacritics, $replacements, $string);
}

@endphp
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        tfoot td { font-weight: bold; background-color: #e2e8f0; }
    </style>
</head>
<body>
    <h2>Pontaj - Saptamana {{ $week }} / {{ $year }}</h2>

    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Zi</th>
                <th>Angajat</th>
                <th>Tip activitate</th>
                <th>Suma</th>
                <th>Saptamana</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $row)
                <tr>
                    <td>{{ removeDiacritics($row['data']) }}</td>
                    <td>{{ removeDiacritics($row['zi']) }}</td>
                    <td>{{ removeDiacritics($row['angajat']) }}</td>
                    <td>{{ removeDiacritics($row['tip']) }}</td>
                    <td>{{ removeDiacritics(number_format($row['suma'], 2)) }} lei</td>
                    <td>{{ removeDiacritics($row['saptamana']) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;">Total general:</td>
                <td colspan="2">{{ removeDiacritics(number_format($total, 2)) }} lei</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
