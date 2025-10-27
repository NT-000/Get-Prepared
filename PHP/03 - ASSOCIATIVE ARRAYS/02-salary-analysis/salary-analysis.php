<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../simple.css">
    <title>Salary analysis - exercise</title>
</head>
<body>
<pre>
    <?php

    $hrSalaries = ['Alice' => 4600, 'Bob' => 6000, 'Charlie' => 5500];
    //$hrSalaries = ['Alice' => 5000];
    $salesSalaries = ['David' => 6200, 'Elena' => 4800, 'Fiona' => 5300];
    //$salesSalaries = ['David' => 6200];
    $itSalaries = ['Fiona' => 5300, 'George' => 5600, 'Hannah' => 4800, 'Ivan' => 6400];
    //$itSalaries = ['Fiona' => 5300];

    $hrExpenses = array_values($hrSalaries);
    $salesExpenses = array_values($salesSalaries);
    $itExpenses = array_values($itSalaries);

    $hrTotal = array_sum($hrSalaries);
    $salesTotal = array_sum($salesSalaries);
    $itTotal = array_sum($itSalaries);

    $totals = ['HR' => $hrTotal, 'Sales' => $salesTotal, 'IT' => $itTotal];

    $highestDepSal = max($totals);
    echo "Highest salary by department: {$highestDepSal}\n";
    $highestDep = array_search($highestDepSal, $totals);

    $maxDept = $highestDep;

    echo "Highest expenses department-name: $maxDept \n";

    $rNum = rand(0, 2);

    if ($rNum == 0) $companySalaries = array_merge($hrSalaries, $salesSalaries, $itSalaries);
    elseif ($rNum == 1) $companySalaries = ['Alice' => 5000, 'Bob' => 6000, 'Charlie' => 5500];
    else $companySalaries = ['Alice' => 4000, 'Bob' => 2000, 'Charlie' => 3000];

    $lowSalary = min($companySalaries);

    $lowestSalaries = [];


    foreach ($companySalaries as $employee => $salary) {

        if ($salary === $lowSalary) {
            $lowestSalaries[$employee] = $salary;
        }

    }
    echo "Lowest salaries:\n";
    var_dump($lowestSalaries);

    $averageSalary = array_sum(($companySalaries)) / (count($companySalaries));
    $averageSalary2 = round($averageSalary, 0);


    echo "Employees that earns more than average salary: {$averageSalary2}\n";

    $oldCompanySalaries = array_sum($companySalaries);


    foreach ($companySalaries as $employee => $salary) {
        if ($salary < $averageSalary) {
            $newSalary = $salary + 200;
            $companySalaries[$employee] = $newSalary;
            echo "{$employee} gets a raise - new salary: {$salary}\n<br>";
        } else if ($salary > $averageSalary) {
            $newWage = $salary * 0.95;
            $companySalaries[$employee] = $newWage;
            echo "{$employee} gets a wage reduction - new salary: {$newWage}\n";
        }
    }

    $newCompanySalaries = array_sum($companySalaries);

    if ($newCompanySalaries > $oldCompanySalaries) {
        $net = $newCompanySalaries - $oldCompanySalaries;
        echo "The net impact of the salary adjustments is a cost increase of \${$net} for the company.";
    } else if ($newCompanySalaries < $oldCompanySalaries) {
        $net = $oldCompanySalaries - $newCompanySalaries;
        echo "The net impact of the salary adjustments is a savings of \${$net} for the company.";
    } else {
        echo "The net impact of the salary adjustments is a cost increase of \$0 for the company.";
    }

    ?>
</pre>
</body>
</html>

