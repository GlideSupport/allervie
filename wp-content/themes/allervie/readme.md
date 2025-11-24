# === BaseTheme Package ===

## Contributors: Abu Bakar

Tags: custom-menu, full-width-template, theme-options, translation-ready
Requires at least: 5.8
Tested up to: 5.8
Stable tag: 1.0.0

A BaseTheme Package WordPress theme

## Description

This is a BaseTheme Package WordPress theme

## Instruction

-   **html_entity_decode()** Function is used to decode the escaped html
-   **html_entity_remove()** Function is used to remove the escaped html
-   You Donot need to use isset check condition<br>
    **$alrv_page_pagetitle = (isset($fields['alrv_pagetitle'])) ? $fields['alrv_pagetitle'] : null;**
-   Not needed Use<br>
    **$alrv_page_pagetitle = $fields['alrv_pagetitle'];**
-   CTA is moved in footer
-   page-section section now close in the file it starts.
-   use the condition bellow to get page title it will take the acf field name as input if field is null it will return page title<br>
    **$alrv_pagetitle=glide_page_title('alrv_pagetitle');**
-   Move sw.js from pwa folder to parent public folder when doing setup
