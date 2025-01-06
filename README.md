# Gemini - CollectiveAccess

Gemini is a plugin developed for CollectivaAccess (that is an open-source software platform designed for 
managing and presenting collections of various types, including museum artifacts, archival materials, and library materials. 
It's particularly suitable for large and complex collections that require sophisticated cataloging and search capabilities).

This plugin automates the creation of concise data using Gemini (large language model developed by Google AI. 
It's designed to be more advanced than previous models, capable of understanding and responding to complex queries), 
which are then integrated into CollectiveAccess's database. 

Firstly, Gemini contains a modulo that allows to generate artist's biography. 

# Requirements on CollectiveAccess (Providence)

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

# Requirements on Pawtucket 
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
## Tutorial (on Providence)

  - If installing was successfully: now, we have a menu **Gemini > Entities**. Select it. 
    ![](imgs/tutorial-image01.png)

  - A list of all artist is shown. Select an artist. 
    ![](imgs/tutorial-image02.png)
    
  - A form is shown. There is a textbox with a text "brief biography of ---" (this text can be modified according to your preferences). Click on button gemini to initialize the searh using Gemini API. 
    ![](imgs/tutorial-image03.png)
    
    The result is saved on the second textarea. 
    ![](imgs/tutorial-image04.png)
    In the bottom side, we have 4 icon buttons:
      - Save: this icon saves the first textarea's content (*biography*) in memory. 
      - Clear: This icon erases all data in the first textarea's content (*biography*). 
      - Add: This icon selects the second textarea's content (*query to gemini*) to be added to the first textarea's content (*biography*). 
      - Delete and Add: This icon replaces the first textarea's content (*query to gemini*) with second textarea's content (*biography*). 

  - Go to menu **manage > administration > USER INTERFACES** and select to edit **Standard entity editor** (click no icon edit).
    ![](imgs/tutorial-image05.png)

  - Create a new screen **Extra info** (the name is not important!).    
    ![](imgs/tutorial-image05.png)
