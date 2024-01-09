# PHP

```
PHP
├─ library-app
│  ├─ apache_config.conf
│  ├─ composer.json
│  ├─ composer.lock
│  ├─ config
│  │  └─ database.php
│  ├─ docker-compose.yml
│  ├─ Dockerfile
│  ├─ initialize_db.php
│  ├─ public
│  │  ├─ .htaccess
│  │  └─ index.php
│  ├─ src
│  │  ├─ Contracts
│  │  │  ├─ BaseContract.php
│  │  │  ├─ BookContract.php
│  │  │  ├─ ReaderContract.php
│  │  │  ├─ TakeBookContract.php
│  │  │  └─ WriteOffBookContract.php
│  │  ├─ Controller
│  │  │  ├─ BaseController.php
│  │  │  ├─ BookController.php
│  │  │  └─ ReaderController.php
│  │  ├─ Exception
│  │  │  ├─ BaseException.php
│  │  │  ├─ ContractException.php
│  │  │  ├─ DatabaseException.php
│  │  │  ├─ ModelException.php
│  │  │  └─ RepositoryException.php
│  │  ├─ Helper
│  │  │  └─ DatabaseConnection.php
│  │  ├─ Http
│  │  │  ├─ Request.php
│  │  │  └─ Response.php
│  │  ├─ Model
│  │  │  ├─ Author.php
│  │  │  ├─ BaseModel.php
│  │  │  ├─ Book.php
│  │  │  ├─ BookAuthor.php
│  │  │  ├─ Loan.php
│  │  │  └─ Reader.php
│  │  ├─ Repository
│  │  │  ├─ AuthorRepository.php
│  │  │  ├─ BaseRepository.php
│  │  │  ├─ BookRepository.php
│  │  │  ├─ LoanRepository.php
│  │  │  └─ ReaderRepository.php
│  │  ├─ Router
│  │  │  ├─ include_routers.php
│  │  │  ├─ Router.php
│  │  │  └─ RouterInterface.php
│  │  └─ Service
│  │     ├─ AuthorService.php
│  │     ├─ BookService.php
│  │     ├─ LoanService.php
│  │     └─ ReaderService.php
│  └─ vendor
│     ├─ autoload.php
│     └─ composer
│        ├─ autoload_classmap.php
│        ├─ autoload_namespaces.php
│        ├─ autoload_psr4.php
│        ├─ autoload_real.php
│        ├─ autoload_static.php
│        ├─ ClassLoader.php
│        ├─ installed.json
│        ├─ installed.php
│        ├─ InstalledVersions.php
│        └─ LICENSE
└─ README.md

```