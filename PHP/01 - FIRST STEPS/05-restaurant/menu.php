<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <style>
        :root {
            --bg: #0f1013;
            --card: #151821;
            --ink: #e9ecf1;
            --muted: #b7bdc8;
            --gold: #d4af37;
            --rule: #2a2f3b;
        }

        * {
            box-sizing: border-box
        }

        html, body {
            height: 100%
        }

        body {
            margin: 0;
            background: radial-gradient(1200px 800px at 20% 0%, #1a1e28 0%, #0e1016 60%, var(--bg) 100%) fixed;
            color: var(--ink);
            font: 16px/1.6 "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Ubuntu, "Helvetica Neue", Arial, sans-serif;
        }

        .menu-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            z-index: 1;
        }

        .menu {
            width: min(900px, 100%);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0)), var(--card);
            border: 1px solid var(--rule);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .35), inset 0 1px 0 rgba(255, 255, 255, .04);
            overflow: hidden;
        }

        .menu > div:first-child {
            text-align: center;
            padding: 40px 28px 24px;
            border-bottom: 1px solid var(--rule);
            background: linear-gradient(180deg, rgba(212, 175, 55, .12), transparent);
        }

        .logo {
            display: inline-grid;
            place-items: center;
            width: 72px;
            height: 72px;
            margin: 0 auto 12px;
            border-radius: 50%;
            border: 1px solid rgba(212, 175, 55, .5);
            color: var(--gold);
            font-weight: 700;
            letter-spacing: .12em;
        }

        h1 {
            margin: .2rem 0;
            font-size: 1.9rem;
            letter-spacing: .06em;
            font-weight: 800;
            text-transform: uppercase;
        }

        .subtitle {
            color: var(--muted);
            font-size: .98rem
        }

        .wrap {
            display: grid;
            gap: 28px;
            padding: 28px
        }

        section {
            padding: 20px 22px;
            border: 1px solid var(--rule);
            border-radius: 16px;
            background: rgba(255, 255, 255, .01);
        }

        h2 {
            margin: 0 0 10px;
            font-size: 1.15rem;
            text-transform: uppercase;
            letter-spacing: .14em;
            color: var(--gold);
        }

        .course {
            display: grid;
            gap: 6px;
            padding: 14px 0;
            border-top: 1px dashed var(--rule)
        }

        .course:first-of-type {
            border-top: none;
            padding-top: 0
        }

        .title {
            font-weight: 700;
            font-size: 1.05rem
        }

        .desc {
            color: var(--muted)
        }

        .pair {
            font-style: italic;
            color: #cfd5e1
        }

        .grid {
            display: grid;
            gap: 22px;
            grid-template-columns: 1fr;
        }

        @media (min-width: 820px) {
            .grid {
                grid-template-columns: 1.1fr .9fr
            }
        }

        .list {
            margin: 0;
            padding: 0;
            list-style: none;
            display: grid;
            gap: 10px
        }

        .item {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            border-top: 1px dashed var(--rule);
            padding-top: 10px
        }

        .item:first-child {
            border-top: none;
            padding-top: 0
        }

        .name {
            font-weight: 600
        }

        .note {
            color: var(--muted)
        }

        footer {
            border-top: 1px solid var(--rule);
            padding: 16px 22px;
            color: var(--muted);
            font-size: 0.9rem;
            text-align: center;
        }

        @media print {
            body {
                background: white;
                padding: 0
            }

            .menu {
                box-shadow: none;
                border: none;
                border-radius: 0
            }

            header, footer, section {
                break-inside: avoid
            }

            a {
                color: inherit;
                text-decoration: none
            }
        }

        .title {
            border-bottom: 5px solid var(--rule);
        }
    </style>
</head>

<body>

<?php
$headerImage = "images/menu.png";
$page = "menu";
include "layouts/header.php"; ?>
<div class="menu-container">

    <article class="menu" role="document" aria-labelledby="title">

        <div>
            <div class="logo">★</div>
            <h1 id="title">Chef’s Tasting Menu</h1>
            <p class="subtitle">Five-course experience with curated pairings</p>
        </div>

        <div class="wrap">
            <div class="grid">
                <section>
                    <h2 id="courses">Tasting Menu</h2>

                    <div class="course">
                        <div class="title">Amuse-Bouche — Oyster Trio</div>
                        <div class="desc">Served on crushed ice with cucumber granita, citrus foam &amp; ponzu pearls.
                        </div>
                        <div class="pair">Pairing: Champagne Brut Rosé</div>
                    </div>

                    <div class="course">
                        <div class="title">Starter — Caramelized Scallops</div>
                        <div class="desc">Cauliflower purée, crispy pancetta &amp; truffle oil drizzle.</div>
                        <div class="pair">Pairing: Sancerre, Domaine Vacheron (Loire, France)</div>
                    </div>

                    <div class="course">
                        <div class="title">Main — Wagyu Beef Tenderloin</div>
                        <div class="desc">Roasted bone marrow, smoked potato cream &amp; red wine jus.</div>
                        <div class="pair">Pairing: Cabernet Sauvignon, Stags’ Leap (Napa Valley, USA)</div>
                    </div>

                    <div class="course">
                        <div class="title">Cheese Interlude — Artisan Selection</div>
                        <div class="desc">Aged Comté, goat cheese &amp; blue Stilton with fig chutney.</div>
                        <div class="pair">Pairing: Taylor’s 20 Year Old Tawny Port</div>
                    </div>

                    <div class="course">
                        <div class="title">Dessert — Dark Chocolate Sphere</div>
                        <div class="desc">Molten praline heart, gold leaf &amp; salted caramel ice cream.</div>
                        <div class="pair">Pairing: Late Harvest Riesling, Dr. Loosen (Mosel, Germany)</div>
                    </div>
                </section>


                <section>
                    <h2 id="drinks">Drinks Menu</h2>

                    <h3 class="title" style="margin-top:0">Wines</h3>
                    <ul class="list" aria-label="Wine List">
                        <li class="item"><span class="name">White</span><span class="note">Chablis Premier Cru, Domaine Laroche</span>
                        </li>
                        <li class="item"><span class="name">Red</span><span class="note">Brunello di Montalcino, Castiglion del Bosco</span>
                        </li>
                        <li class="item"><span class="name">Rosé</span><span class="note">Whispering Angel, Côtes de Provence</span>
                        </li>
                        <li class="item"><span class="name">Sparkling</span><span
                                    class="note">Dom Pérignon Vintage 2013</span></li>
                    </ul>

                    <h3 class="title" style="margin-top:18px">Cocktails</h3>
                    <ul class="list" aria-label="Cocktail List">
                        <li class="item"><span class="name">Elderflower Martini</span><span class="note">Gin, St-Germain, lemon twist</span>
                        </li>
                        <li class="item"><span class="name">Smoked Old Fashioned</span><span class="note">Bourbon, smoked syrup, orange zest</span>
                        </li>
                        <li class="item"><span class="name">Cucumber Cooler</span><span class="note">Vodka, mint, cucumber &amp; tonic</span>
                        </li>
                    </ul>

                    <h3 class="title" style="margin-top:18px">Non-Alcoholic</h3>
                    <ul class="list" aria-label="Non-alcoholic List">
                        <li class="item"><span class="name">Sparkling Elderflower Water</span><span class="note">Floral &amp; refreshing</span>
                        </li>
                        <li class="item"><span class="name">Cold-Pressed Apple &amp; Ginger</span><span class="note">Bright, lightly spicy</span>
                        </li>
                        <li class="item"><span class="name">Jasmine Iced Tea</span><span class="note">Hand-brewed, delicate aroma</span>
                        </li>
                    </ul>
                </section>
            </div>
        </div>

        <footer>
            Kindly inform us of any allergies or dietary requirements.
        </footer>
    </article>
</div>
</body>
</html>