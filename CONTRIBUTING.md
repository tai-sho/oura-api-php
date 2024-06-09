# Contributing to Oura API PHP Client

First off, thanks for taking the time to contribute! 🎉

The following is a set of guidelines for contributing to this project. These are mostly guidelines, not rules. Use your best judgment, and feel free to propose changes to this document in a pull request.

## How Can I Contribute?

### Reporting Bugs

This section guides you through submitting a bug report for the Oura API PHP Client. Following these guidelines helps maintainers and the community understand your report, reproduce the behavior, and find related reports.

Before creating a bug report, please check if an issue has already been reported.

1. **Check the [issues](https://github.com/your-username/oura-api-php/issues) for similar problems.**
2. **If you find a related issue, add a comment with any additional details.**
3. **If your issue is unique, open a new issue:**
   - Use a clear and descriptive title for the issue to identify the problem.
   - Provide as much relevant information as possible to help others understand the problem and how to reproduce it.

### Suggesting Enhancements

This section guides you through submitting an enhancement suggestion for the Oura API PHP Client, including completely new features and minor improvements to existing functionality.

1. **Check the [issues](https://github.com/your-username/oura-api-php/issues) for similar suggestions.**
2. **If you find a related suggestion, add a comment with your thoughts.**
3. **If your suggestion is new, open a new issue:**
   - Use a clear and descriptive title for the issue to identify the suggestion.
   - Provide a detailed description of the suggested enhancement and explain why it would be beneficial.

### Submitting a Pull Request

1. Fork the repository.
2. Clone your fork to your local machine:
   ```sh
   git clone https://github.com/your-username/oura-api-php.git
   cd oura-api-php
```
3. Create a new branch for your changes:
   ```
   git checkout -b feature/your-feature-name
```
4. Make your changes in your branch.
5. Commit your changes:
   ```sh
   git commit -m "Description of your changes"
```
6. Push to your fork:
   ```sh
   git push origin feature/your-feature-name
```
7. Open a pull request from your forked repository to the main repository.

### Pull Request Guidelines
- Ensure any install or build dependencies are removed before the end of the layer when doing a build.
- Update the README.md and any other relevant documentation with details of changes to the interface.
- Ensure the test suite passes.
- Make sure your code lints.

## Development
### Using Docker for Development
We provide a Docker setup to ensure a consistent development environment. To use Docker:
1. Build the Docker image:
   ```sh
   docker-compose build
```
2. Run the development environment:
   ```sh
   docker-compose up
```
3. Use the php environment:
   ```sh
   docker-compose exec app bash
```

The Docker setup will automatically install dependencies and run tests, code style checks and static analysis.

### Code Style and Analysis
Please ensure your code adheres to our coding standards and passes all checks:
1. PHP-CS-Fixer: Ensures code style consistency.
   ```sh
   vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.php --diff --allow-resky=yes
```
2. PHPStan: Performs static analysis to detect potential issues.
   ```sh
   vendor/bin/phpstan analyse -c phpstan.neon
```
3. PHPMD: Checks for code smells and potential bugs.
   ```sh
   vendor/bin/phpmd src text phpmd.xml
```

## Code of Conduct
This project and everyone participating in it is governed by the Code of Conduct. By participating, you are expected to uphold this code. Please report unacceptable behavior to tai-sho@tech-style.info.

## Thank You
Thank you for considering contributing to the Oura API PHP Client! We look forward to building something amazing with you.
