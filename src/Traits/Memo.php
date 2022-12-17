<?php
declare(strict_types=1);

namespace Electrum\Traits;

trait Memo
{

    private string|null $memo = "";

    public function getMemo(): string|null
    {
        return $this->memo;
    }

    public function setMemo(string|null $memo): static
    {
        $this->memo = $memo;

        return $this;
    }

}
