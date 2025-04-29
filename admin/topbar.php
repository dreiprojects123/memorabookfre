<style>
  .topbar {
    background: linear-gradient(90deg, #0062cc, #0d6efd);
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    padding: 0;
    min-height: 3.5rem;
  }
  
  .logo-container {
    display: flex;
    align-items: center;
  }
  
  .logo {
    margin-right: 10px;
    margin-left: 10px;
    font-size: 20px;
    background: white;
    padding: 7px 11px;
    border-radius: 50%;
    color: #0d6efd;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .system-name {
    font-size: 1.25rem;
    font-weight: 600;
    color: white;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
  }
  
  .user-dropdown .dropdown-toggle {
    color: white;
    font-weight: 500;
    text-decoration: none;
    display: flex;
    align-items: center;
    transition: all 0.2s ease;
    margin-right: 10px;
  }
  
  .user-dropdown .dropdown-toggle:hover {
    opacity: 0.9;
  }
  
  .user-dropdown .dropdown-toggle::after {
    margin-left: 0.5rem;
  }
  
  .user-dropdown .dropdown-menu {
    box-shadow: 0 3px 10px rgba(0,0,0,0.15);
    border: none;
    border-radius: 0.5rem;
    margin-top: 0.5rem;
  }
  
  .user-dropdown .dropdown-item {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 5px;
  }
  
  .user-dropdown .dropdown-item i {
    margin-right: 0.5rem;
    width: 1rem;
    text-align: center;
  }
  
  .user-dropdown .dropdown-item:hover {
    background: #f8f9fa;
    color: #0d6efd;
  }
  
  .user-icon {
    background: rgba(255,255,255,0.2);
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.5rem;
  }
</style>

<nav class="navbar navbar-expand-lg fixed-top topbar">
  <div class="container-fluid">
    <div class="logo-container">
      <div class="logo">
        <i class="fa fa-book"></i>
      </div>
      <span class="system-name"><?php echo isset($_SESSION['system']['name']) ? $_SESSION['system']['name'] : 'MemoraBook' ?></span>
    </div>
    
    <div class="user-dropdown dropdown">
      <a href="#" class="dropdown-toggle" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="user-icon">
          <i class="fa fa-user"></i>
        </div>
        <?php echo $_SESSION['login_name'] ?>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="account_settings">
        <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account">
          <i class="fa fa-cog"></i> Manage Account
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="ajax.php?action=logout">
          <i class="fa fa-power-off"></i> Logout
        </a>
      </div>
    </div>
  </div>
</nav>

<script>
  $('#manage_my_account').click(function(){
    uni_modal("Manage Account","manage_user.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
  })
</script>