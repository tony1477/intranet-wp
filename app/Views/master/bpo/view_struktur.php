<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>
    <!-- DataTables -->
    <!-- <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" /> -->

    <!-- Responsive datatable examples -->
    <!-- <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> -->
    <?= $this->include('partials/head-css') ?>   
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.0.279/build/pdf.min.js"></script>
</head>

<body>
  <?php if(!file_exists(base_url().'/assets/protected/'.$dir.'/'.$data))
      // $data = [
			// 	'title_meta' => view('partials/title-meta', ['title' => 'Structure-Org']),
			// 	'data' => $row[$field],
			// 	'dir' => $name,
			// ];
      // return view('pages-404',$data);
      echo 'test';
   ?>
<canvas id="the-canvas"></canvas>

<script type="text/javascript">
    const url = '<?=base_url()?>/assets/protected/<?=$dir?>/<?=$data?>';

    const loadingTask = pdfjsLib.getDocument(url);
  (async () => {
    const pdf = await loadingTask.promise;
    //
    // Fetch the first page
    //
    const page = await pdf.getPage(1);
    const scale = 1.5;
    const viewport = page.getViewport({ scale });
    // Support HiDPI-screens.
    const outputScale = window.devicePixelRatio || 1;

    //
    // Prepare canvas using PDF page dimensions
    //
    const canvas = document.getElementById("the-canvas");
    const context = canvas.getContext("2d");

    canvas.width = Math.floor(viewport.width * outputScale);
    canvas.height = Math.floor(viewport.height * outputScale);
    canvas.style.width = Math.floor(viewport.width) + "px";
    canvas.style.height = Math.floor(viewport.height) + "px";

    const transform = outputScale !== 1 
      ? [outputScale, 0, 0, outputScale, 0, 0] 
      : null;

    //
    // Render PDF page into canvas context
    //
    const renderContext = {
      canvasContext: context,
      transform,
      viewport,
    };
    page.render(renderContext);
  })();
</script>
</html>