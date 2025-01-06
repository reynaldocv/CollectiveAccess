# Gemini - CollectiveAccess

Gemini is a plugin developed for CollectivaAccess (that is an open-source software platform designed for 
managing and presenting collections of various types, including museum artifacts, archival materials, and library materials. 
It's particularly suitable for large and complex collections that require sophisticated cataloging and search capabilities).

This plugin automates the creation of concise data using Gemini (large language model developed by Google AI. 
It's designed to be more advanced than previous models, capable of understanding and responding to complex queries), 
which are then integrated into CollectiveAccess's database. 

Firstly, Gemini contains a modulo that allows to generate artist's biography. 

# Requirenents on CollectiveAccess (providence)

  - Go to menu **manage > administration**.
    ![](imgs/collectiveaccess-image01.png)

  - Select a **METADATA ELEMENTS** and blick on right side buttion **New**.
    ![](imgs/collectiveaccess-image01_.png)  
  - Create a metadata element with the below information (**biography**), 
    ![](imgs/collectiveaccess-image02.png)
    
    add the following restriction (this restriction garantes that the metadata biography is atributed only to **individuals** entities). And, save it. 
    ![](imgs/collectiveaccess-image03.png)  

  - Go to menu **manage > administration > USER INTERFACES** and select to edit **Standard entity editor** (click no icon edit).
    ![](imgs/collectiveaccess-image04.png)

  - Create a new screen **Extra info** (the name is not important!).    
    ![](imgs/collectiveaccess-image05.png)

  - Enter to this new screen config. And, in the section "screen content", move the metadata element **biography** (initially positioned in the left side) to the rigth side.
    And save it.
    ![](imgs/collectiveaccess-image06.png)

  - Now, we can see in the editing individuals the screen **Extra info** with the **biography** field.
    ![](imgs/collectiveaccess-image07.png)

# Requirenents on Pawtucket 
  - Edit the file "[Pawtucket's path]/themes/default/views/Details/ca_entities_default_html.php". And, add the following code:
    ```html
    {{{<ifdef code="ca_entities.biography"><div class='unit'><H6>Biography</H6>^ca_entities.biography</div></ifdef>}}}
    ```
    See below:
    ![](imgs/pawtucket-image01.png)

# Installation

  - This folder can be copied to path of [CollectiveAccess' path]/app/plugins or the below code can be executed:
    ```
    git clone https://github.com/reynaldocv/Geminip-CollectiveAccess.git
    ```
> [!IMPORTANT]
> Once done, it is needed to rename the folder to "gemini". 
  
  - Now, you need to generate a APIKEY from google applications (https://ai.google.dev/gemini-api/docs) and copied to file [CollectiveAccess' path]/app/plugins/gemini/Gemini.conf.

    ```
    APIKEY = "copied_here_your_api_key_to_use_Gemini" 
    ```
## Tutorial

<p align="center">
  <img src="img/vamos-usuarionuevo.png">       
</p>

## Tela de Criação de um novo usuário

<p align="center">
  <img src="img/vamos.usuarionuevo.png">       
</p>

<p align="center">
  <img src="img/vamos-hobbies.png">       
</p>

## Tela de Eventos por Categorias

<p align="center">
  <img src="img/vamos-categorias.png">       
</p>

## Tela de Lista de Eventos como Postagens

<p align="center">
  <img src="img/vamos-eventos.png">       
</p>


## Tela de Lista de Eventos num Map

<p align="center">
  <img src="img/vamos-maps.png">       
</p>


## Tela de Chat (para estabelecer um encontro)

<p align="center">
  <img src="img/vamos-chat.png">       
</p>

