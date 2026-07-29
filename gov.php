<?php
$schemes = [
    [
        "name" => "PM-KUSUM (Pradhan Mantri Kisan Urja Suraksha Evam Utthan Mahabhiyan)",
        "description" => "A scheme to promote solar-powered irrigation pumps and grid-connected solar power plants.",
        "benefits" => "Subsidy of up to 60% for farmers to install solar pumps.",
        "eligibility" => "Farmers with land for installation of solar pumps and power plants.",
        "apply_link" => "https://mnre.gov.in/solar/schemes-programmes"
    ],
    [
        "name" => "Solar Rooftop Subsidy Scheme",
        "description" => "Government provides subsidies for installing rooftop solar panels for households and businesses.",
        "benefits" => "Subsidy of up to 40% for residential rooftop solar installation.",
        "eligibility" => "Homeowners, housing societies, and institutions.",
        "apply_link" => "https://solarrooftop.gov.in"
    ],
    [
        "name" => "State Government Solar Subsidy Programs",
        "description" => "Various state governments provide additional solar subsidies.",
        "benefits" => "Extra incentives on top of central government subsidies.",
        "eligibility" => "Varies by state.",
        "apply_link" => "https://mnre.gov.in/"
    ],
    [
        "name" => "SECI (Solar Energy Corporation of India) Tenders",
        "description" => "Government tenders and projects for large-scale solar power production.",
        "benefits" => "Support for businesses investing in solar projects.",
        "eligibility" => "Companies and industries in the renewable energy sector.",
        "apply_link" => "https://seci.co.in/"
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Solar Government Schemes - India</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #white;}
        .container { margin-top: 30px; }
        .container h2{ color:rgb(5, 167, 167);}
        .scheme-card { background:  #f4f4f4; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-apply { background-color: #28a745; color: white; text-decoration: none; padding: 10px 15px; border-radius: 5px; }
        .btn-apply:hover { background-color: #218838; }
    </style>
</head>
<body>

<!-- Header -->
<!-- <nav class="navbar text-black navbar-dark bg-light ">
    <div class="container">
        <a class="navbar-brand" href="#">Indian Government Solar Schemes</a>
    </div>
</nav> -->
<?php
require('cheader.php');
?>
<!-- Main Content -->
<div class="container">
    <h2 class="text-center mb-4">Government Schemes for Solar Products in India</h2>

    <div class="row">
        <?php foreach ($schemes as $scheme): ?>
            <div class="col-md-6 mb-4">
                <div class="scheme-card">
                    <h4><?= $scheme['name']; ?></h4>
                    <p><strong>Description:</strong> <?= $scheme['description']; ?></p>
                    <p><strong>Benefits:</strong> <?= $scheme['benefits']; ?></p>
                    <p><strong>Eligibility:</strong> <?= $scheme['eligibility']; ?></p>
                    <a href="<?= $scheme['apply_link']; ?>" class="btn-apply" target="_blank">Apply Now</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<!-- Footer -->
<footer class="text-center mt-5 p-3 bg-light text-white">
    &copy; 2024 Solar Schemes India | <a href="https://mnre.gov.in/" class="text-white">Ministry of New and Renewable Energy</a>
</footer>

</body>
</html>
