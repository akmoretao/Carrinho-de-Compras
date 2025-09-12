# Carrinho-de-Compras

## Nome/RA
Ana Karla de Souza Moretão -
1986881

## Projeto
O objetivo do projeto é simular um carrinho de compras, desenvolvido em PHP puro e aplicando boas práticas como **DRY**, **KISS** e **PSR-12**.

## Funcionalidades Implementadas

1. **Adicionar item ao carrinho**
- Valida se o produto existe
- Valida se há estoque o suficiente.
- Atualiza o carrinho e reduz o estoque.

2. **Remover item do carrinho**
- Valida se o item existe no carrinho.
- Atualiza o carrinho e devolve ao estoque.

3. **Listar itens do carrinho**
- Exibe produto, quantidade, preço e subtotal.

4. **Calcular total**
- Soma todos os subtotais.
- Aplica o cupom de desconto (`DESCONTO10` -> 10%).

5. **Aplicar/remover cupom de desconto**
- Aceita cupom válido ou remove se nulo/vazio.

6. **Limpar carrinho**
- Remove todos os itens e restaura estoques.

## Regras de Negócio

- Cada produto tem: `id`, `name`, `price`, `stock`.
- O carrinho mantém `productId`, `quantity` e `subtotal`.
- Cupom de desconto aplicado ao total final, se válido.
- Tudo é armazenado em arrays (sem banco de dados).
- Não há interface de usuário, os testes são feitos diretamente no `index.php`.
