# **solid-srp-demo**

Projeto simples em **PHP**, desenvolvido para demonstrar o **Princípio da Responsabilidade Única (Single Responsibility Principle - SRP)** do **SOLID**.  
O sistema permite **cadastrar e listar produtos**, aplicando separação clara de responsabilidades entre camadas.

---

##  **Integrantes**
- Alexandre — 1686088  
- João — 2003753  

---

##  **Como executar**

1. **Pré-requisitos:**  
   - PHP instalado (com **Composer**)  
   - Servidor local como **XAMPP**

2. **Configuração:**  
   ```bash
   composer dump-autoload
   ```

3. **Execução:**  
   - Inicie o servidor Apache no XAMPP  
   - Acesse no navegador:  
     ```
     http://localhost/solid-srp-demo/
     ```

---

##  **Estrutura do Projeto**
```
solid-srp-demo/
├── public/                  # Camada de apresentação (views e entradas HTTP)
│   ├── index.php            # Página inicial
│   ├── create.php           # Cadastro de produtos
│   └── products.php         # Listagem de produtos
├── src/                     # Código fonte organizado em camadas
│   ├── Application/         # Serviços e orquestração da lógica
│   │   └── ProductService.php
│   ├── Contracts/           # Interfaces e contratos
│   │   ├── ProductRepository.php
│   │   └── ProductValidator.php
│   ├── Domain/              # Entidades e regras de negócio
│   │   ├── Product.php
│   │   └── SimpleProductValidator.php
│   └── Infra/               # Persistência e infraestrutura
│       └── FileProductRepository.php
├── storage/                 # Dados armazenados localmente
│   └── products.txt
├── vendor/                  # Dependências do Composer
├── composer.json            # Configuração e autoload PSR-4
└── README.md
```

---

##  **Conceito aplicado**
Este projeto aplica o **Princípio da Responsabilidade Única (SRP)**, garantindo que cada classe tenha apenas uma função clara:
- **Entidades** cuidam dos dados.  
- **Serviços** gerenciam as operações.  
- **Repositórios** tratam a persistência.  
- **Validações** garantem consistência dos dados.
