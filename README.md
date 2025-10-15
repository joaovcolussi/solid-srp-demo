
# solid-srp-demo

### Grupo
- **Alexandre - 1686088**
- **João - 2003753**

Projeto simples em PHP com duas funções:
- **Cadastro e listagem de produtos**

## Como executar
1. Requisitos: PHP (com Composer) e XAMPP.
2. Rode `composer dump-autoload`
3. Starta o Xampp
4. Acesse no navegador: `http://localhost/solid-srp-demo/`

## Estrutura
```
/SOLID-SRP-DEMO
├── public/                 # Camada de Apresentação (Views e Entradas HTTP)
│   ├── create.php          # (Cadastro/Processamento do POST)
│   ├── index.php           # (Página Principal ou Rota)
│   └── products.php        # (Listagem de Produtos)
├── src/                    # Código Fonte da Aplicação (Organizado por Camadas/Namespaces)
│   ├── Application/        # Camada de Aplicação/Serviço
│   │   └── ProductService.php    # (Orquestração da lógica de negócio)
│   ├── Contracts/          # Camada de Contratos/Interfaces
│   │   ├── ProductRepository.php # (Interface para persistência)
│   │   └── ProductValidator.php  # (Interface para validação)
│   ├── Domain/             # Camada de Domínio/Lógica de Negócio
│   │   ├── Product.php           # (Entidade principal)
│   │   └── SimpleProductValidator.php  # (Implementação da lógica de validação)
│   └── Infra/              # Camada de Infraestrutura/Persistência
│       └── FileProductRepository.php # (Implementação do Repositório - Lida com arquivos)
├── storage/                # Dados e Arquivos de Persistência
│   └── products.txt        # (Arquivo de dados - Simula o banco de dados)
├── vendor/                 # Dependências do Composer (Autoload)
├── composer.json           # Configuração do projeto e Autoloading PSR-4
├── composer.lock
└── README.md
```

