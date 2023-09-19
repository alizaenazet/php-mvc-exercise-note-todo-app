<?php include('../controllers/controller_note.php') ?>
<?php
$noteIndex = isset($_GET['noteIdx']) ? $_GET['noteIdx'] : null;
$noteValue = getNote($noteIndex)
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <div class="flex justify-center items-center flex-col">
  <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="http://localhost:8080/views/view_note.php" class="flex items-center">
      <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">WowNote</span>
  </a>
  <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
    <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
      <li>
        <a href="view_note.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700" aria-current="page">Home</a>
      </li>
      <li>
        <a href="view_addNote.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Add note</a>
      </li>
    </ul>
  </div>
  </div>
</nav>
    
    <div class="mt-20 ">
        
<div  class="flex justify-center items-center flex-col block w-screen max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?=$noteValue->title?></h5>
    
    <!-- Text area for content of the note -->
<form method="POST" action="../controllers/controller_note.php"  class="w-[100%]" >
    <input  name="noteIDX" value="<?=$noteIndex?>" type="hidden">    
   <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
       <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
           <label for="noteContent" class="sr-only">Your comment</label>
           <textarea name="noteContent" rows="10" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="write your note here" required><?=$noteValue->content ?></textarea>
       </div>
       <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
           <button type="submit" name="saveNote"  class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
               Save note
           </button>
       </div>
   </div>
</form>

<!-- Todolist card -->
<div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white">
            Todolist
        </h5>
            <div>
            <!-- Todolist input -->
        <form method="POST" action="../controllers/controller_note.php" >   
            <label  class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">add new todo</label>
            <div class="relative">
            <input  name="noteIDX" value="<?=$noteIndex?>" type="hidden">    
            <input  name="newTodo"  class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="add new todo" required>
                <button type="submit" name="addNoteTodo" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">add</button>
            </div>
        </form>

                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">add for new todo</p>
            </div>
        <ul class="my-4 space-y-3">
            <?php foreach ($noteValue->todoList as $index => $todo) { ?>
                <li>
                <div class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                    <div class="flex items-center">
                        <a href="http://localhost:8080/controllers/controller_note.php?reStatusTodo=<?=$index?>&noteIndx=<?=$noteIndex?>">
                            <input type="checkbox" value="<?=$todo->isFinish?>" <?=$todo->isFinish? "checked" : "" ?>  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </a>
                        <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"></label>
                    </div>
                    <span class="flex-1 ml-3 whitespace-nowrap"><?=$todo->todo?></span>
                    <a href="http://localhost:8080/controllers/controller_note.php?deleteTodo=<?=$index?>&noteIndx=<?=$noteIndex?>" class="text-blue-700 border border-red-700  hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800 dark:hover:bg-red-500">
                        x
                        <span class="sr-only">remove todo</span>
            </a>
                </div>
            </li>
                <?php } ?>
        </ul>
    </div>

</div>

    </div>

    </div>
</body>
</html>