<div class="left-div">
    

    <button class="left-button" <?= $active === "actHome" ? "id='Active'":""; ?> onclick="home_function()">
        <span class="material-symbols-outlined">
          home
        </span>
        <p>Home</p>
      </button>

      <button class="left-button" <?= $active === "actUser" ? "id='Active'":""; ?> onclick="view_emp()" >
        <span class="material-symbols-outlined">
          person
        </span>
        <p>Users</p>
      </button>

      <button class="left-button" <?= $active === "actSenior" ? "id='Active'":""; ?> onclick="view_senior()">
        <span class="material-symbols-outlined">
          elderly
        </span>
        <p>Seniors</p>
      </button>

      <button class="left-button" <?= $active === "actRequest" ? "id='Active'":""; ?> onclick="view_requests()">
        <span class="material-symbols-outlined">
          description
        </span>
        <p>Requests</p>
        <?php
          if($row_count > 0){

        ?>
        <div id="req-notif">
          <?= $row_count ?>
        </div>
        <?php
          }
        ?>
      </button>

      <button class="left-button" <?= $active === "actEvent" ? "id='Active'":""; ?> onclick="event_logs()">
        <span class="material-symbols-outlined">
          menu_book
        </span>
        <p>Event Logs</p>
      </button>

      <a href="admin_activities.php" style="text-decoration: none;">
      <button class="left-button" <?= $active === "actActivity" ? "id='Active'":""; ?> onclick="activiy_function()">
        <span class="material-symbols-outlined">
          hiking
        </span>
        <p>Activities/Events</p>
      </button>
      </a>
      

      <button class="logout-button" onclick="logout_function()">
        <span class="material-symbols-outlined">
          logout
        </span>
        <p>Logout</p>
      </button>
    </div>