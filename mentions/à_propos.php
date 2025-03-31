<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>À propos - Zoo Arcadia</title>
  <link rel="stylesheet" href="styles.css"> <!-- Assure-toi d'avoir un fichier CSS -->

  <!-- Ajoutez les styles de typographie ici -->
  <link rel="stylesheet" href="../fonts/fonts-style-1.css" type="text/css">

  <!--
    <link href="https://fonts.cdnfonts.com/css/rajdhani" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Tangerine" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">
     -->

  <!--<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500&display=swap" rel="stylesheet">-->

</head>

<body>
  <header>
    <h1>À propos du Zoo Arcadia</h1>
  </header>

  <main>
    <section>
      <p>Bienvenue au Zoo Arcadia, un lieu d’émerveillement et de découverte dédié à la préservation de la faune et à l’éducation du public. Situé dans un cadre naturel exceptionnel, notre zoo accueille une grande diversité d’espèces animales venant des quatre coins du monde.</p>
    </section>

    <section>
      <h2>Notre mission</h2>
      <p>Le Zoo Arcadia a pour objectif de sensibiliser les visiteurs à la protection de la biodiversité et de contribuer activement à la conservation des espèces menacées. Nous nous engageons à offrir des conditions de vie optimales aux animaux tout en favorisant la recherche scientifique et l’éducation environnementale.</p>
    </section>

    <section>
      <h2>Nos valeurs</h2>
      <ul>
        <li><strong>Bien-être animal</strong> : Nos équipes veillent au quotidien à garantir des soins adaptés et un environnement enrichissant pour nos pensionnaires.</li>
        <li><strong>Éducation et sensibilisation</strong> : À travers des visites pédagogiques, des ateliers interactifs et des conférences, nous aidons petits et grands à mieux comprendre le monde animal et les enjeux environnementaux.</li>
        <li><strong>Conservation</strong> : Nous participons à des programmes de reproduction en captivité et soutenons des initiatives internationales pour la préservation des espèces en danger.</li>
      </ul>
    </section>

    <section>
      <h2>Un espace unique</h2>
      <p>Le Zoo Arcadia est aménagé en plusieurs zones thématiques représentant les principaux écosystèmes de la planète :</p>
      <ul>
        <li><strong>La Savane Africaine</strong> : Découvrez les majestueux lions, girafes et éléphants évoluant dans un espace vaste et naturel.</li>
        <li><strong>La Jungle Tropicale</strong> : Plongez au cœur d’une forêt luxuriante où vivent singes, perroquets colorés et reptiles exotiques.</li>
        <!--<li><strong>Le Monde Polaire</strong> : Observez les ours polaires et les manchots dans un environnement reproduisant fidèlement leur habitat naturel.</li>-->
        <li><strong>Le Marais Mystérieux</strong> : Explorez un environnement fascinant peuplé d’amphibiens, de reptiles et d’oiseaux aquatiques vivant au rythme des marécages.</li>


      </ul>
    </section>

    <section>
      <h2>Une expérience pour toute la famille</h2>
      <p>Nous proposons des parcours immersifs, des rencontres avec les soigneurs et des animations ludiques adaptées à tous les âges. Que vous soyez passionné de nature, amateur de photographie animalière ou simplement curieux, le Zoo Arcadia vous promet une visite inoubliable.</p>
    </section>
  </main>

  <footer>
    <p>© 2025 Zoo Arcadia - Ce projet est fictif et réalisé dans le cadre d’un examen.</p>
  </footer>
</body>

</html>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>A_propos</title>

  <!-- Ajoutez les styles de typographie ici -->
  <link rel="stylesheet" href="./fonts/fonts-style-1.css" type="text/css">
  <!-- Import des polices -->
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500&display=swap" rel="stylesheet">

  <style>
    /*===============================*/
    /* Section Engagement écologique */
    /*===============================*/
    #eco {
      padding: 2rem;
      background: #2A7E50;
      color: #fff;
      text-align: center;
    }

    #eco h2 {
      margin-bottom: 1.5rem;
    }


    /* Ajustement du texte dans les sections */
    h1,
    h2 {
      font-size: 1.5em;
    }

    h1 {
      font-size: clamp(24px, 5vw, 48px) !important;
      /* Min 24px, Max 48px */
      text-align: center !important;
      /*margin: 1rem 0;*/
      line-height: 1.2;
      /*color: #ffff;*/

      /*font-weight: 500;*/
      /*desactivé */
      background: #2A7E50;
      color: white;
    }


    .eco-content {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
    }

    .eco-content img {
      width: 100%;
      max-width: 500px;
      border-radius: 10px;
    }

    .eco-content img {
      animation-delay: 0.7s;
    }
  </style>

</head>

<body>
  <!--<h1>A Propos de ce site</h1>-->

  <!-- Section Engagement écologique -->
  <section id="eco">
    <h2>Nos engagements pour la planète</h2>
    <div class="eco-content">
      <p>Arcadia est fier d'être 100% indépendant énergétiquement grâce à l'énergie solaire et éolienne.
        <br>
        Nous mettons un point d'honneur à réduire notre empreinte carbone et à sensibiliser nos visiteurs.
      </p>
      <!--<p>Nous mettons un point d'honneur à réduire notre empreinte carbone et à sensibiliser nos visiteurs.</p>-->
      <img src="../public/assets/images/image10.jpg" alt="Panneaux solaires"><!-- solar-panels.jpg  -->
      <!--<img src="../assets/a_propos/image10.jpg" alt="Panneaux solaires">-->
    </div>
  </section>

</body>

</html>