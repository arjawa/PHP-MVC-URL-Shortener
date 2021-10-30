<main>
    <section id="form-section">
      <h1 id="web-title">Url Shortener</h1>
      <form class="form" action="actions/insert" method="post">
        <div class="form-group">
          <input 
          type="text" 
          name="url" 
          class="input"
          placeholder="Shorten your link"
          required
          <?php
            echo isset($_SESSION['result']) ? ' value="' . $_SESSION['result'] . '"' : '';
          ?>>
          <button type="submit" class="button">Shorten</button>
        </div>
        <?php if (isset($_SESSION['status'])): ?>
        <table border="1" cellspacing="0" class="table">
          <tr>
            <td>Status</td>
            <td><?= $_SESSION['status']; ?></td>
          </tr>
          <tr>
            <td>Long URL</td>
            <td><span class="text-wrapper"><?= $_SESSION['url']; ?></span></td>
          </tr>
          <tr>
            <td>Short URL</td>
            <td><span class="text-wrapper"><?= $_SESSION['result']; ?></span></td>
          </tr>
        </table>
        <?php 
          endif;
          session_destroy();
        ?>
      </form>
    </section>
  </main>