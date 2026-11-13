<?php
$message = '';
$formData = [
    'nume' => '',
    'email' => '',
    'pachet' => 'Weekend de liniște',
    'mesaj' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($formData as $field => $value) {
        $formData[$field] = trim($_POST[$field] ?? $value);
    }

    if ($formData['nume'] !== '' && filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
    $storageFile = __DIR__ . '/data/reservations.json';
    $reservations = [];

    if (is_file($storageFile)) {
      $storedReservations = json_decode((string) file_get_contents($storageFile), true);
      if (is_array($storedReservations)) {
        $reservations = $storedReservations;
      }
    }

    $reservations[] = [
      'nume' => $formData['nume'],
      'email' => $formData['email'],
      'pachet' => $formData['pachet'],
      'mesaj' => $formData['mesaj'],
      'created_at' => date(DATE_ATOM),
    ];

    file_put_contents(
      $storageFile,
      json_encode($reservations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
      LOCK_EX
    );
        $message = 'Cererea a fost trimisă. Vă vom contacta în curând.';
        $formData['mesaj'] = '';
    } else {
        $message = 'Completați numele și introduceți o adresă de email validă.';
    }
}

function escapeHtml(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ro">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mountain Escape</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <header>
      <div class="container topbar">
        <div class="logo">Mountain Escape</div>
        <nav aria-label="Navigare principală">
          <ul>
            <li><a href="#despre">Despre</a></li>
            <li><a href="#experiente">Experiențe</a></li>
            <li><a href="#galerie">Galerie</a></li>
            <li><a href="#rezervari">Rezervări</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <main>
      <section class="container hero" id="despre">
        <div>
          <h1>Explorați munții în ritmul vostru.</h1>
          <p>
            Întâlniți sălbăticia, liniștea și aventurile autentice într-un colț magic al naturii.
            Fie că vă place drumeția, fotografia sau relaxarea în cabane rustice, avem o experiență
            făcută pentru tine.
          </p>
          <div class="cta-row">
            <a class="btn btn-primary" href="#rezervari">Rezervă acum</a>
            <a class="btn btn-secondary" href="#galerie">Vezi galeria</a>
          </div>
        </div>
        <div class="hero-image">
          <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=900&q=80" alt="Peisaj montan cu lac și pădure" />
        </div>
      </section>

      <section class="container" id="experiente">
        <h2>De ce să ne alegi?</h2>
        <div class="features">
          <article class="feature">
            <h3>Trasee spectaculoase</h3>
            <p>Drumeții adaptate pentru începători și pasionați, cu vedere panoramică și o natură impresionantă.</p>
          </article>
          <article class="feature">
            <h3>Cazare confortabilă</h3>
            <p>Cabane moderne, cu paturi calde, cafea proaspătă și o atmosferă plăcută, de la dimineață până seara.</p>
          </article>
          <article class="feature">
            <h3>Experiențe autentice</h3>
            <p>Însoțitori locali, mese tradiționale și activități care vă conectează cu cultura montană.</p>
          </article>
        </div>
      </section>

      <section class="container" id="galerie">
        <h2>Galerie</h2>
        <div class="gallery">
          <figure>
            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=900&q=80" alt="Vârf de munte" />
            <figcaption>Vârfuri acoperite de zăpadă și cer albastru.</figcaption>
          </figure>
          <figure>
            <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80" alt="Lac montan" />
            <figcaption>Peisaje de vis, perfecte pentru fotografii.</figcaption>
          </figure>
          <figure>
            <img src="https://images.unsplash.com/photo-1470770841072-f978cf4d019e?auto=format&fit=crop&w=900&q=80" alt="Pădure și munte" />
            <figcaption>Drumeții prin păduri verzi și văi liniștite.</figcaption>
          </figure>
        </div>
      </section>

      <section class="container" id="rezervari">
        <h2>Planificați vacanța</h2>
        <div class="info-grid">
          <div>
            <p>
              În sezonul de vară și iarnă organizăm tururi de drumeție, safari foto și weekenduri de relaxare
              în natură. Pentru o experiență completă, puteți alege unul dintre pachetele noastre preferate.
            </p>
            <ul class="checklist">
              <li>Drumeție ghidată de la 2 până la 7 zile</li>
              <li>Cabane cu mic dejun inclus</li>
              <li>Transport local către trasee</li>
              <li>Suport pentru fotografie și observare a faunei</li>
            </ul>
            <p>Vezi mai multe detalii pe <a href="https://www.example.com" target="_blank" rel="noopener noreferrer">pagina oficială</a>.</p>
          </div>
          <div>
            <table aria-label="Pachete turistice">
              <thead>
                <tr><th>Pachet</th><th>Durată</th><th>Preț</th></tr>
              </thead>
              <tbody>
                <tr><td>Weekend de liniște</td><td>2 zile</td><td>320 €</td></tr>
                <tr><td>Drumeție panoramica</td><td>4 zile</td><td>540 €</td></tr>
                <tr><td>Vacanță premium</td><td>7 zile</td><td>980 €</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <section class="container">
        <h2>Formular de rezervare</h2>
        <?php if ($message !== ''): ?>
          <p role="status"><?= escapeHtml($message) ?></p>
        <?php endif; ?>
        <div class="form-card">
          <form method="post" action="#rezervari">
            <div class="field">
              <label for="nume">Nume</label>
              <input id="nume" name="nume" type="text" placeholder="Introdu numele complet" value="<?= escapeHtml($formData['nume']) ?>" required />
            </div>
            <div class="field">
              <label for="email">Email</label>
              <input id="email" name="email" type="email" placeholder="exemplu@email.com" value="<?= escapeHtml($formData['email']) ?>" required />
            </div>
            <div class="field">
              <label for="pachet">Pachet preferat</label>
              <select id="pachet" name="pachet">
                <option <?= $formData['pachet'] === 'Weekend de liniște' ? 'selected' : '' ?>>Weekend de liniște</option>
                <option <?= $formData['pachet'] === 'Drumeție panoramică' ? 'selected' : '' ?>>Drumeție panoramică</option>
                <option <?= $formData['pachet'] === 'Vacanță premium' ? 'selected' : '' ?>>Vacanță premium</option>
              </select>
            </div>
            <div class="field">
              <label for="mesaj">Mesaj</label>
              <textarea id="mesaj" name="mesaj" placeholder="Spune-ne preferințele tale..."><?= escapeHtml($formData['mesaj']) ?></textarea>
            </div>
            <button class="submit-btn" type="submit">Trimite cererea</button>
          </form>
        </div>
      </section>
    </main>

    <footer>
      <div class="container">Mountain Escape © 2026 • Natură, aventură și relaxare</div>
    </footer>
  </body>
</html>