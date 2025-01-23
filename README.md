# Steam Workshop Collection Downloader

A tool for downloading Steam Workshop Collections using SteamCMD. Created by gamers for gamers, this free utility simplifies the process of managing Workshop content through an easy-to-use web interface.

## Project Structure

- `/css` - Stylesheet files
- `/js` - JavaScript files
- `/includes` - PHP includes
- `/pages` - PHP page files
- `/downloads` - Download resources

## Setup Requirements

- PHP 7.4 or higher
- Apache/Nginx web server
- SteamCMD installation
- Appropriate write permissions for logs and download directories

## Setup Instructions

1. Clone the repository
2. Configure web server (Apache/Nginx)
3. Set up proper permissions for logs directory
4. Configure environment-specific settings

## Development Workflow

This project utilizes a structured branch strategy:
- `main`: Production-ready code
- `staging`: Pre-production testing
- `develop`: Active development
- Feature branches: New functionality implementation

## Development Roadmap

### Phase 1: Critical Text Updates (on hold)
- [ ] Revise texts regarding SteamCMD requirements
- [ ] Help documentation for collection-download.php
- [ ] Documentation for non-Steam platform mods

### Phase 2: Structural Changes (current priority)
#### File Structure Reorganization
1. Split collection-download.php
   - New command generation page
   - New download page for Workshop Manager and TamperMonkey

2. Guide Consolidation
   - Merge workshop-guide.php and server-setup.php
   - Content integration
   - Revision of combined documentation

3. File Structure
   - Review filenames in /pages directory
   - Ensure consistent naming conventions
   - Update all internal links

4. Navigation
   - Adapt navigation to new structure
   - Update menu items
   - Verify all navigation paths

### Phase 3: Additional Documentation (not started)
- [ ] SteamCMD usage documentation
- [ ] Collection usage documentation