<?php
function APIResponseWithReturn($result, $reponse, $responseText,$additionalResponse,$additionalResponseText)
{
    header('Content-type: application/json');
    $response = array('result' => $result, 'response' => $reponse, 'responseText' => $responseText,
        'additionalResponse' => $additionalResponse,'additionalResponseText' => $additionalResponseText);
    echo json_encode($response);;
}

?>

