<?php defined('_JEXEC') or die('Restricted access');

//      JToolBarHelper::back();

$exportFilename = date('Y-m-d') . '_places_export' . '.csv';

JResponse::clearHeaders();

JResponse::setHeader('Pragma', 'public', true);
JResponse::setHeader('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT', true); // Date in the past
JResponse::setHeader('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT', true);
JResponse::setHeader('Cache-Control', 'no-store, no-cache, must-revalidate', true); // HTTP/1.1
JResponse::setHeader('Cache-Control: pre-check=0, post-check=0, max-age=0', true); // HTTP/1.1
JResponse::setHeader('Pragma', 'no-cache', true);
JResponse::setHeader('Expires', '0', true);
JResponse::setHeader('Content-Transfer-Encoding', 'none', true);
JResponse::setHeader('Content-Type', 'application/csv', true); // joomla will overwrite this...
JResponse::setHeader('Content-Disposition', 'attachment; filename="' . $exportFilename . '"', true);

// joomla overwrites content-type, we can't use JResponse::setHeader()
$d = JFactory::getDocument();
$d->setMimeEncoding('application/csv');

// stop output buffering or we will run out of memory with large tables.
ob_end_flush();

JResponse::sendHeaders();
$output = fopen('php://output', 'w');
fputcsv($output,
    array(
        'id',
        'division_id',
        'ward',
        'division',
        'pin_address',
        'display_address',
        'zip_code',
        'location',
        'building',
        'parking',
        'lat',
        'lng',
        'elat',
        'elng',
        'alat',
        'alng',
        'published',
        'created',
        'updated',
    )
);

$k = 0;
for ($i = 0, $n = count($this->items); $i < $n; $i++) {
    $row = &$this->items[$i];
    fputcsv($output,
        array(
            $row->id,
            $row->division_id,
            $row->ward,
            $row->division,
            $row->pin_address,
            $row->display_address,
            $row->zip_code,
            $row->location,
            $row->building,
            $row->parking,
            $row->lat,
            $row->lng,
            $row->elat,
            $row->elng,
            $row->alat,
            $row->alng,
            $row->published,
            $row->created,
            $row->updated,
        )
    );
    $k = 1 - $k;
}
