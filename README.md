🚀 Greenhouse Job Board WordPress Plugin

Version: 1.2
Author: Tomás Vilas
License: GPL-3.0

Overview 📄

The Greenhouse Job Board WordPress Plugin integrates seamlessly with the Greenhouse API, allowing you to fetch and display job postings from your Greenhouse account directly on your WordPress site. Designed with flexibility in mind, this plugin provides an easy-to-use solution to manage job listings, offering customization options and full control over the appearance and functionality via WPBakery integration.

Key Features 🎯

  Fetch job listings: Pulls job listings directly from Greenhouse's API.
  Customizable display: Group job postings by department and dynamically display job counts.
  Search functionality: A built-in search bar enables visitors to filter job listings in real-time.
  Light/Dark theme toggle: Administrators can choose between light and dark themes for job post styling.
  Cache management: Automatically caches job listings to optimize performance and reduce API calls. The cache can be manually cleared from the admin panel.
  WPBakery Integration: Easy drag-and-drop functionality with WPBakery page builder, enabling effortless placement of job boards without additional configurations.
  Admin panel settings: Allows customization of the Job Board Token, search bar visibility, and more.

Installation 🛠️

  Upload the plugin: Download and upload the plugin to your WordPress site via the WordPress plugin directory or by manually uploading the files via FTP.
  Activate the plugin: Go to Plugins > Installed Plugins and activate the "Greenhouse Job Board" plugin.
  Configure settings: Navigate to Settings > Greenhouse Job Board to input your Greenhouse Job Board Token and customize the plugin options.

How to Use 📋

  WPBakery Integration:
  You can easily add the job board to any page via WPBakery. The plugin integrates directly with WPBakery, allowing you to add the "Greenhouse Job Board" as a content block. There are no extra options needed; just drag and drop the block into the desired section of your page.

  Shortcode Usage:
  The plugin also provides a shortcode to embed job listings on any page or post:

    [greenhouse_jobs]

Customization 🎨
Light/Dark Mode 🌓

In the WPBakery settings for the block, you can choose between two display styles:

  Light Mode: Displays job listings with black text.
  Dark Mode: Displays job listings with white text for dark backgrounds.

Admin Panel Options ⚙️

  Job Board Token: Input your Greenhouse Job Board Token to link your Greenhouse account.
  Search Bar Visibility: Toggle the visibility of the search bar to allow users to filter job postings.
  Clear Cache: Clear the cached job listings if you need to update job information immediately.

Development 💻

The plugin is designed to be developer-friendly. It uses standard WordPress hooks and the Greenhouse API for fetching data. All caching is managed with WordPress transients to optimize the API's performance.

File Structure 🗂️

    greenhouse-integration/
    ├── includes/
    │   ├── admin-page.php         # Handles admin settings and cache management
    │   ├── api-fetch.php          # Fetches job listings from the Greenhouse API
    │   ├── shortcode.php          # Defines the [greenhouse_jobs] shortcode
    │   ├── wpbakery-block.php     # WPBakery integration for drag-and-drop functionality
    ├── css/
    │   └── greenhouse-styles.css  # Plugin-specific styles
    └── greenhouse-job-board.php   # Main plugin file


License 📜

This plugin is licensed under the GPL-3.0 License. You are free to use, modify, and distribute this plugin under the terms of the license.
Contributing 🤝

Contributions are welcome! Please fork the repository and submit a pull request with your changes.
