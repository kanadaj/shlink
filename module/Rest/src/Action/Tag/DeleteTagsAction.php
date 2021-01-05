<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\Rest\Action\Tag;

use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Shlinkio\Shlink\Core\Tag\TagServiceInterface;
use Shlinkio\Shlink\Rest\Action\AbstractRestAction;

class DeleteTagsAction extends AbstractRestAction
{
    protected const ROUTE_PATH = '/tags';
    protected const ROUTE_ALLOWED_METHODS = [self::METHOD_DELETE];

    private TagServiceInterface $tagService;

    public function __construct(TagServiceInterface $tagService)
    {
        $this->tagService = $tagService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $query = $request->getQueryParams();
        $tags = $query['tags'] ?? [];

        $this->tagService->deleteTags($tags);
        return new EmptyResponse();
    }
}
