
### Trunk Based Development

> We can video call hahahahhaa

This way of development will help us avoid overwriting each others code changes. For further information, feel free to read this article: [Trunk Based Development](https://trunkbaseddevelopment.com/short-lived-feature-branches/#two-developers-concurrently-doing-short-lived-feature-branches)

#### Naming Convention for Branching

- Should be understandable
- `snake_case`

#### Branching

```text
master
feature/display_order_slips_page
feature/fetch_order_slips
feature/style_order_slips_page
```

#### Naming Convention FOR DEVELOPMENT

- Folder Naming: `snake_case`
- Class Naming: `PascalCase`
- Method/Function Naming: `camelCase`
- Constant variable Naming: `SNAKE_CASE`
- All other variables: `camelCase`

> Variable names should be understandable (indicating what they are for)  
> _**Don'ts**_ (e.g. x, y, z, basta)  
> _**Dos**_ (e.g. index, categories, category, slips, slip, orderItems, orderItem)

### _**Front-end Folder Structure**_ Proposal


```text
|-- views
    |-- src
        |-- common
            |-- css
            |-- js
                |-- utils
                |-- components
            |-- misc
                |-- images
                    |-- image.jpg
                |-- framework
                    |-- ....
        |-- css
            |-- page_name
                |-- pageCss.css
        |-- js
            |-- page_name
                |-- pageJs.js
        |-- misc
            |-- page_name
                |-- ....
        |-- html
            |-- page_name
                |-- htmlFile.html
```

### _**Back-end Folder Structure**_ Proposal

> Use folder structure provided by CodeIgniter
