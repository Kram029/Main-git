<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrack - News</title>

      <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      background-image: url('background.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;
      font-family: 'Quattrocento', serif;
      padding-top: 0px;
    }

    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: rgba(255, 255, 255, 0.6);
      z-index: -1;
    }

    /* Headline Section */
    .headline {
    width: 80%; /* Set the width to a smaller percentage */
    max-width: 1000px; /* Optional: Set a maximum width for larger screens */
    padding: 20px 0;
    text-align: center;
    font-size: 40px;
    font-weight: 700;
    background: #D9D9D9;
    margin: 20px auto; /* Center the box horizontally */
    border: 2px solid #000;  /* Adds a solid black border around the box */
    border-radius: 8px;  /* Rounded corners */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);  /* Subtle shadow to make it pop */
    }


    .black-line {
      height: 2px;
      background-color: black;
    }

    /* News Grid */
    .news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 50px;
    max-width: 1200px;
    margin: 40px auto 0;
    padding: 10px;
    width: 100%;
    }

        .card {
    width: 100%;
    background: #FFFFFF;
    border: 2px solid #000000;
    border-radius: 10px;
    overflow: hidden;
    }

    .card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    }

    .card-content {
    padding: 15px;
    }

    .card-content h4 {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 10px;
    }

    .card-content p {
    font-size: 14px;
    margin-bottom: 60px;
    display: -webkit-box;
    -webkit-line-clamp: 3;  /* Show up to 3 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    }
    
    .read-more {
    display: inline-block;
    padding: 5px 15px;
    background: #4CAF50;
    color: #000000;
    text-decoration: none;
    border-radius: 4px;
    font-weight: 700;
    font-size: 14px;
    float: right;
    cursor: pointer;
    position: absolute;
    bottom: 15px;
    right: 15px;
    }
  </style>

</head>
<body>

  <!-- Navbar -->
 <?php include 'navbar.php'; ?>

  <h2 class="headline">Latest News & Updates</h2>
<div class="black-line"></div>

<div class="news-grid">

    <!-- News Cards -->
    <div class="card">
      <img src="https://resource.chemlinked.com.cn/sustainability/articles/mixed-plastics-20210406-by-marina-onokhina-shutterstock-1441540925-web.jpg" alt="Plastic Action Partnership">
      <div class="card-content">
        <h4>Philippines Launches National Plastic Action Partnership to Tackle Plastic Waste and Advance Circular Economy</h4>
        <p>On March 9, 2025, the Department of Environment and Natural Resources (DENR) launched the National Plastic Action Partnership (NPAP), a multi-stakeholder platform designed to foster collaboration across sectors and accelerate the country’s transition to a circular economy.</p>
        <a href="https://sustainability.chemlinked.com/news/philippines-launches-national-plastic-action-partnership-to-tackle-plastic-waste-crisis" class="read-more" target="_blank" rel="noopener noreferrer">Read More</a>
      </div>
    </div>

    <div class="card">
      <img src="https://media.philstar.com/photos/2024/12/30/6_2024-12-30_19-37-55.jpg" alt="Garbage Debts Manila">
      <div class="card-content">
        <h4>Manila Faces ₱561 Million in Unpaid Debts for Garbage Collection</h4>
        <p>As of January 6, 2025, Manila's garbage contractors reported that the city government has accumulated unpaid debts amounting to P561 million for garbage collection services.</p>
        <a href="https://www.philstar.com/nation/2025/01/06/2412272/manila-has-p561-million-unpaid-debts-garbage-collection-waste-firm-says" class="read-more" target="_blank" rel="noopener noreferrer">Read More</a>
      </div>
    </div>

    <div class="card">
      <img src="https://i0.wp.com/marketmonitor.com.ph/wp-content/uploads/2025/01/6-MMDA.webp?resize=660%2C330&ssl=1" alt="MMDA Expo">
      <div class="card-content">
        <h4>MMDA Boosts Zero Waste Campaign</h4>
        <p>In January 2025, the Metropolitan Manila Development Authority (MMDA) organized the "Road to Zero Waste Expo" in Pasig City. The expo aimed to promote sustainable waste management practices and featured various booths showcasing upcycled products.</p>
        <a href="https://marketmonitor.com.ph/mmda-promotes-sustainable-waste-management/" class="read-more" target="_blank" rel="noopener noreferrer">Read More</a>
      </div>
    </div>

    <div class="card">
      <img src="https://resource.chemlinked.com.cn/sustainability/articles/garbage-2729608-1280.jpg" alt="Solid Waste Import Ban">
      <div class="card-content">
        <h4>Senate Bill No. 2957 Filed to Ban Solid Waste Imports</h4>
        <p>On January 27, 2025, Senate Bill No. 2957, titled "An Act Banning the Importation of Solid Waste, Providing Penalties for Violations Thereof, and for Other Purposes," was filed in the Philippine Senate. The bill aims to prohibit the importation of solid waste into the country and establish penalties for violations.</p>
        <a href="https://sustainability.chemlinked.com/news/philippines-senate-bills-to-ban-solid-waste-import" class="read-more" target="_blank" rel="noopener noreferrer">Read More</a>
      </div>
    </div>

    <div class="card">
      <img src="https://i.ytimg.com/vi/GXEMTpakpd0/maxresdefault.jpg" alt="Traslacion Garbage">
      <div class="card-content">
        <h4>Traslacion 2025 Leaves 100 Truckloads of Garbage</h4>
        <p>The annual Traslacion procession in January 2025 resulted in the collection of over 100 truckloads, approximately 400 metric tons, of garbage. This figure highlights the environmental impact of large public events and underscores the need for effective waste management strategies during such occasions.</p>
        <a href="https://www.gmanetwork.com/news/topstories/metro/932535/traslacion-2025-leaves-100-truckloads-of-garbage/story/" class="read-more" target="_blank" rel="noopener noreferrer">Read More</a>
      </div>
    </div>

    <div class="card">
      <img src="https://files01.pna.gov.ph/category-list/2025/03/12/bacolod-waste-complex-groundbreaking-120325.jpg" alt="Bacolod Waste Project">
      <div class="card-content">
        <h4>Bacolod City Launches ₱160-Million Comprehensive Waste Management Project</h4>
        <p>On March 12, 2025, Bacolod City initiated a PHP 160-million comprehensive waste management project aimed at enhancing the city's solid waste management system. The project includes the establishment of a central material recovery facility and the procurement of equipment to improve waste collection and processing. This initiative is part of the city's efforts to promote environmental sustainability and comply with the Ecological Solid Waste Management Act.</p>
        <a href="https://www.pna.gov.ph/articles/1245904" class="read-more" target="_blank" rel="noopener noreferrer">Read More</a>
      </div>
    </div>
  </div>

</div><!-- End of news-grid div-->

  <!-- Footer -->
<?php include 'footer.php'; ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>